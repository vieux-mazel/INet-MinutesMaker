<?php namespace VM\MinuteMaker\Components;

use Cms\Classes\ComponentBase;
use VM\MinuteMaker\Models\Point as Pt;
use VM\MinuteMaker\Models\Seance as Seances;
use Mail;
class Seance extends ComponentBase
{
    public $seance;
    public $point;
    public function componentDetails()
    {
        return [
            'name'        => 'Seance Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    public function onAddPoint(){
        $order = 1;
        #$this->seance = $this->page['seance'];
        $this->seance = $this->page['seance'] = Seances::find(post('seance_id'));
        if($this->seance->points){
            foreach ($this->seance->points() as $point){
                $order++;
            }
        }
        $pt = New Pt;
        $pt->seance = $this->seance;
        $pt->name = post('pointName');
        $pt->order = $order;
        $pt->save();
        $this->seance = $this->page['seance'] = Seances::find(post('seance_id'));

    }
    public function onEditPoint(){
        $pt_href = post('point_href');
        $this->point = Pt::where('href', $pt_href)->first();
        $this->point->pv = post('pv_'.$pt_href);
        $this->point->save();
        $this->point = $this->page['point'] = Pt::where('href', $pt_href)->first();
        $this->seance = $this->page['seance'] = $this->point->seance;
    }
    public function onSendOj(){
        // Send to multiple addresses
        $params = [
            'seance' => $this->page['seance'],
            'ns' => $this->page['ns'],
            'category' => $this->page['category']
        ];
        Mail::send('vm.minutemaker::mail.oj', $params, function($message) {
                $message->to('robin.fave@gmail.com', 'Robin Fave');
            });
    }
}
