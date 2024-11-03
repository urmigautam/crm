<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Env;


class MailController extends Controller
{
    public function index(){
        return view('admin.Email');
    }

    public function create(Request $req){
      
        $mail=new Mail();
         $mail->servername =$req->sname;
         $mail->smtpaddress =$req->saddress;
         $mail->username =$req->user;
         $mail->password =$req->pwd;
         $mail->tls_required =$req->tls == 'yes' ? 0 :1;
         $mail->is_default =$req->isdefault == 'yes' ? 0 :1;
         $mail->is_active =$req->isactive == 'yes' ? 0 :1;
         $mail->port =$req->port;
         $mail->created_by ='1';
         $mail->created_at =date('Y-m-d H:i:s');
         $mail->updated_at =date('Y-m-d H:i:s');
 
        $mail->save();
       
        toastr()->success('Server Created Sucessfully');
        return redirect('/mail-list');
        
 
    }

    public function maillist(){
       
         $mails =Mail::all();
         return view('admin.email_list',compact('mails'));
    }
    public function serveredit($id){
      
        $mail =Mail::find((int)$id);
        return view('admin.editemail',compact('mail'));
    }
    public function serverupdate(Request $req, $id){
        $mail=Mail::find($id);
        $mail->servername =$req->sname;
        $mail->smtpaddress =$req->saddress;
        $mail->username =$req->user;
        $mail->password =$req->pwd;
        $mail->tls_required =$req->tls == 'yes' ? "tls" :"ssl";
        $mail->is_default =$req->isdefault == 'yes' ? 0 :1;
        $mail->is_active =$req->isactive == 'yes' ? 0 :1;
        $mail->port =$req->port;
        $mail->created_by ='1';
        $mail->created_at =date('Y-m-d H:i:s');
        $mail->updated_at =date('Y-m-d H:i:s');

       $mail->update();
  
       $envFilePath = base_path('.env');
       $envContent = file_get_contents($envFilePath);
       $envContentArray = explode("\n", $envContent);

       $mailUpdated=Mail::find($id);

       $MAIL_MAILER=$mailUpdated->servername;
       $MAIL_HOST=$mailUpdated->smtpaddress;
       $MAIL_PORT=$mailUpdated->port;
       $MAIL_USERNAME=$mailUpdated->username;
       $MAIL_PASSWORD=$mailUpdated->password;
       $MAIL_ENCRYPTION=$mailUpdated->tls_required;
      
   
       foreach ($envContentArray as $lineNumber => $line) {
           $envKey = strtok($line, '=');
          
          if ($envKey === "MAIL_MAILER") {
               $envContentArray[$lineNumber] = "MAIL_MAILER=" . $MAIL_MAILER;
               break;
           }
           if ($envKey === "MAIL_HOST") {
            $envContentArray[$lineNumber] = "MAIL_HOST=" . $MAIL_HOST;
            break;
           }
          if ($envKey === "MAIL_PORT") {
            $envContentArray[$lineNumber] = "MAIL_PORT=" . $MAIL_PORT;
            break;
           }
          if ($envKey === "MAIL_USERNAME") {
            $envContentArray[$lineNumber] = "MAIL_USERNAME=" .  $MAIL_USERNAME;
            break;
          }
         if ($envKey === "MAIL_PASSWORD") {
            $envContentArray[$lineNumber] = "MAIL_PASSWORD=" . $MAIL_PASSWORD;
            break;
          }
         if ($envKey === "MAIL_ENCRYPTION") {
            $envContentArray[$lineNumber] = "MAIL_ENCRYPTION=" .$MAIL_ENCRYPTION;
            break;
          }
       
    }
       $newEnvContent = implode("\n", $envContentArray);
       file_put_contents($envFilePath, $newEnvContent);
      
       toastr()->success('Server Updated Sucessfully');
        return redirect('/mail-list');

    }
}
