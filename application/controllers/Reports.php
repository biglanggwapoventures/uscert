<?php

class Reports extends MY_Controller
{
    protected $tabTitle = 'Incident Reports';
	protected $contentTitle = 'Incident Reports';

	protected $viewPath = 'reports';
	protected $resourceName = 'reports';

    function __construct()
	{
		parent::__construct();
        $this->load->model('Report_model', 'report');
        // $this->load->model('Vehicle_model', 'vehicle');
        $this->load->helper('date2');
        $this->load->helper(['organization', 'date2', 'vehicle']);
	}

    function index()
	{
        $view = 'list';

        $errors = [];
        $params = [];
        $input = elements(['start_date', 'end_date', 'organization_id', 'incident_type', 'status'], $this->input->get());

        if(trim($input['start_date'])){
            if(is_valid_date($input['start_date'], 'm/d/Y')){
                $params['r.incident_date >='] = format_date($input['start_date'], 'Y-m-d', 'm/d/Y');
            }
        }

        if(trim($input['end_date'])){
            if(is_valid_date($input['end_date'], 'm/d/Y')){
                $params['r.incident_date <='] = format_date($input['end_date'], 'Y-m-d', 'm/d/Y');
            }
        }

        if(trim($input['incident_type'])){
            if(in_array($input['incident_type'], ['FLOOD', 'CRASH', 'FIRE', 'EARTHQUAKE'])){
                $params['r.incident_type'] = $input['incident_type'];
            }
        }

        if(trim($input['status'])){
            switch($input['status']){
                case 'approved': 
                    $this->contentTitle  = 'Approved '.$this->contentTitle;
                    $this->report->where('r.approved_by IS NOT NULL');
                    break;
                case 'rejected': 
                     $this->contentTitle  = 'Rejected '.$this->contentTitle;
                    $this->report->where('r.rejected_by IS NOT NULL AND r.approved_by IS NULL');
                    break;
                default:
                    $this->contentTitle  = 'Pending '.$this->contentTitle;
                    $this->report->where('r.approved_by IS NULL AND r.rejected_by IS NULL');
                    break;
            }
        }

        $this->report->where($params);

    
        if(user('login_type', 'a')){
            
            $this->report->where([ 'u.organization_id' => user('organization_id') ]);

        }else if(user('login_type', 'v')){

            if($this->input->get('show') === 'own'){
                $this->contentTitle = 'Own Reports';
                $this->report->where(['r.created_by' => user('id')]);
            }
            $this->report->where([ 'u.organization_id' => user('organization_id') ]);

        }else{
            
            if(trim($input['organization_id'])){
                if(organization_exists($input['organization_id'])){
                     $params['u.organization_id'] = $input['organization_id'];
                }else{
                    $errors[] = 'Search criteria for organization ignored. Reason: ORGANIZATION PROVIDED IS INVALID.';
                }
            }
            
            $this->report->where('approved_by IS NOT NULL');

            $view = 'master';

        }

        $items = $this->report->all();

        if($this->input->get('viewType') === 'print'){
            $this->load->view('report-print', compact('items'));
        }else{
            $this->generate_page($view, compact('items'));
        }
		
	}

    function create()
    {
        $this->generate_page('manage', [
            'action' => site_url('reports/store'),
            'title' => 'Create new incident report',
            'data' => [],
        ]);
    }

    function edit($id = FALSE)
    {
        if(!$id || !$data = $this->report->get($id)){
            show_404();
        }

        $data['incident_date'] = format_date($data['incident_date'], 'm/d/Y');
        $data += $data['key_details'];
        unset($data['key_details']);

        $view = user('login_type', 'a') ? 'view' : 'manage';

        $this->generate_page($view, [
            'action' => site_url("reports/update/{$id}"),
            'title' => "Update incident report # {$id}",
            'data' => $data
        ]);
    }

    function store()
    {
        $validation = $this->validate();

        if($validation['result']){
            $data = $validation['data'];
            $data['created_by'] = user('id');
            $id = $this->report->create($data);
            $this->generate_json([ 'result' => TRUE ]);
            return;
        }
        $this->generate_json($validation);
    }

    function update($id = FALSE)
    {
        if(!$id || !$this->report->exists($id)){
            show_404();
        }

        if($this->report->is_approved($id)){
            $this->generate_json([
                'result' => FALSE,
                'errors' => ['Cannot update approved reports']
            ]);
            return;
        }
        
        $validation = $this->validate();

        if($validation['result']){
            $data = $validation['data'];
            $id = $this->report->update($id, $data);
            $this->generate_json([ 'result' => TRUE ]);
            return;
        }
        $this->generate_json($validation);
    }

    function validate()
    {
        $input = $this->input->post();
        if(user('login_type', 'v')){
            $this->form_validation->set_rules('incident_date', 'incident date', ['required', [
            'valid_date', function($val){

            }
            ]], ['valid_date' => 'Please provide a valid date with format: MM/DD/YYYY']);
            $this->form_validation->set_rules('incident_type', 'incident type', 'required|in_list[FLOOD,FIRE,EARTHQUAKE,CRASH]', ['in_list' => 'Please provide the %s.']);
            $this->form_validation->set_rules('alarm', 'alarm', 'required');
            $this->form_validation->set_rules('casualty', 'casualty', 'required');
            $this->form_validation->set_rules('investigator', 'investigator', 'required');
            $this->form_validation->set_rules('actions_taken', 'actions taken', 'required');
            $this->form_validation->set_rules('estimated_damage', 'estimated damage', 'numeric');
            $this->form_validation->set_rules('longitude', 'map marker (longitude)', 'required|decimal');
            $this->form_validation->set_rules('latitude', 'map marker (latitude)', 'required|decimal');
            $this->form_validation->set_rules('formatted_address', ' map marker (full address)', 'required');
            $this->form_validation->set_rules('zoom', ' map marker (zoom value)', 'required|integer');
            $this->form_validation->set_rules('vehicles_used[]', ' Vehicles used', 'numeric');
            

            if(!$this->form_validation->run()){
                return [ 'result' => FALSE, 'errors' => $this->form_validation->errors() ];
            }

            $data = elements(['incident_type', 'actions_taken', 'other_information', 'alarm', 'casualty', 'investigator', 'structures_involved', 'estimated_damage', 'cause', 'longitude', 'latitude', 'formatted_address', 'zoom'], $input);
            $data['incident_date'] = format_date($input['incident_date'], 'Y-m-d', 'm/d/Y');
            $data['vehicles_used'] =  json_encode( !empty($input['vehicles_used']) ? $input['vehicles_used'] : []);

            $key_details = [];

            switch($data['incident_type']){
                case Report_model::TYPE_FLOOD:
                    $key_details = elements(['watershed', 'river', 'intensity', 'cumulative_rainfall'], $input, '');
                    break;
                case Report_model::TYPE_CRASH:
                    $key_details = elements(['vehicle_type', 'location'], $input, '');
                    break;
                case Report_model::TYPE_EARTHQUAKE:
                    $key_details = elements(['magnitude_depth', 'main_cities_affected', 'primary_province', 'other_provinces_impacted'], $input, '');
                    break;
                case Report_model::TYPE_FIRE:
                    $key_details = elements(['alarm_level', 'location'], $input, '');
                    break;
            }

            $data['key_details'] = json_encode($key_details);

        }
       
        if(user('login_type', 'a') && isset($input['status']) && in_array($input['status'], ['a', 'r'])){
            if($input['status'] === 'a'){
                $data['approved_by'] = user('id'); 
                $data['approved_at'] = NULL;
            }else{
                $data['rejected_by'] = user('id'); 
                $data['rejected_at'] = NULL;
            }
            
        }

        return [
            'result' => TRUE,
            'data' => $data
        ];


    }
}