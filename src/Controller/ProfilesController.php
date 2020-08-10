<?php

declare(strict_types=1);

namespace App\Controller;

use Thedudeguy\Rcon;


/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        //Profilephoto
        $session = $this->request->getSession();
        $userid = $session->read('Auth.id');
        $image_folder = '.\profile/' . $userid . '';
        if (!file_exists($image_folder)) {
            mkdir($image_folder, 0777, true);
        }
        $image = array_diff(scandir($image_folder,), array('.', '..'));
        if (!$image) {
            $img = '<img class="profile-image" src="/acwp/webroot/img/placeholder.jpg">';
            $edit = '<a href="Profiles/add">Profilfoto hinzufügen</a>';
        } else {
            /*var_dump($image);
            die;*/
            $image = $image_folder .'/' .$image[2]  ;
            $img = '<img class="profile-image" src='.$image. '>';
            $edit = '<a href="Profiles/edit">Profilfoto ändern</a>';  
        }
        
        //Minecraftserver rcon
        $domain =        "www.acwp-community.de";
        $adresse =       gethostbyname($domain);
        $port =          25575;
        $password = '04As1095!?!';
        $timeout =        3;
        $whitelist = '';
        $this->request->allowMethod(['get', 'post']);
        if ($this->request->is('post')) {
            $whitelist = $this->request->getdata();
            $rcon = new Rcon($adresse, $port, $password, $timeout);

            if ($rcon->connect())
            {
                $rcon->sendCommand('whitelist add '.$whitelist['Ingame_Name']);
                $this->Flash->success(__('Der Benutzer wurde erfolgreich Hinzugefügt.'));    
            }


        }


        /*var_dump($whitelist);
        die;*/

        $this->set(compact('img', 'edit','whitelist'));
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profilesphoto = $this->Profiles->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('profile'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $userid = $session->read('Auth.id');
        $image_folder = '.\profile/' . $userid . '/';
        $session = $this->request->getSession();
        $userid = $session->read('Auth.id');
        $profile = $this->Profiles->newEmptyEntity();
        if ($this->request->is('post')) {

            $fileobject = $this->request->getData('submittedfile');
            $file = substr_replace($fileobject->getClientFilename(), 'image', 0);
            $type = substr($fileobject->getclientMediaType(), 6, 4);
            $uploadPath = $image_folder;

            $destination = $uploadPath . $file . '.' . $type;
            // Existing files with the same name will be replaced.
            /*var_dump($uploadPath,$file,$fileobject,$type,$destination);
                die;*/
            $fileobject->moveTo($destination);
            clearstatcache();
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('profile', 'userid'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $userid = $session->read('Auth.id');
        $image_folder = '.\profile/' . $userid . '';
        if (!file_exists($image_folder)) {
            mkdir($image_folder, 0777, true);
        }
        $image = array_diff(scandir($image_folder,), array('.', '..'));
        $image = $image_folder .'/' .$image[2]  ;
        unlink($image);
        return $this->redirect(['action' => 'index']);
        /*var_dump($image);
        die;*/
    }

    /**
     * Delete method>
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profiles->get($id);
        if ($this->Profiles->delete($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deleteimage()
    {

    }
}