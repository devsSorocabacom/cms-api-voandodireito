<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\NewResultMail;
use App\Result;
use App\Topic;
use App\Info;

use Log;
use DB;

class ResultsContoller extends Controller
{   
    //Salvar novo resultado e notificar administrador via email
    //Os registros sao inseridos nas tabelas 'results' e 'results_itens' 
    //através de transactions no mysql
    public function store(ResultRequest $request){
         
        try { 
            DB::beginTransaction(); 

            $result = $this->storeResultAndItens($request);        

           	$this->sendMailNotification($request);

            DB::commit();
			
            return ['status'=>true,'message'=>'Resultado salvo com sucesso','result'=>$result];
        } catch (\Exception  $th) {
            Log::error("erro",['file'=>'ResultsContoller.store','message'=>$th->getMessage()]);
            
            DB::rollback(); 
            return ['status'=>false,'message'=>'Não foi possível salvar resultado','error'=>$th->getMessage()];
        }

    } 

    //Método exclusivo para salvar resultado e itens 
    private function storeResultAndItens($request){
        $result = Result::create([
            'phone' => $request->phone,
            'email' => $request->email,
            'name' => $request->name,
        ]);

        if(!empty($request->results)){

            foreach($request->results as $topic_id){
                $topic = Topic::find($topic_id);
                $result->itens()->create([
                    'topic_id'=>$topic->id, 
                    'title'=>$topic->title,
                    'text'=>$topic->text
                ]);
            } 

        }
        return $result;
    }

    //Método exclusivo para enviar email de notificação ao administrador do novo resultado registrado
    private function sendMailNotification($request){
        $data = [
            'phone' => $request->phone,
            'email' => $request->email,
            'name' => $request->name,
        ];
        $sendto = Info::find(1)->email;
        Mail::to($sendto)->send(new NewResultMail($data));
    }

}
