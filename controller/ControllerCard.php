<?php

require_once 'model/Card.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerCard extends Controller {

    //page d'accueil.     
    public function index() {
        $this->view();
    }

    public static function get_card_if_exist() {
        $card_id = "";
        if (isset($_GET["param1"]) && $_GET["param1"] != "" && is_numeric($_GET["param1"])) {
            $card_id = $_GET["param1"];
            $card = Card::get_card($card_id);
            if($card){
                return $card;
            }
        }
        return false;
    }

    public function view() {
        $user = $this->get_user_or_redirect();
        $card = $this::get_card_if_exist();
        if($card){
            (new View("card"))->show(array("card" => $card, "user" => $user));
        }else{
            $this->redirect("board","index");
        }
    }


    public function edit() {
        $user = $this->get_user_or_redirect();
        $card = $this::get_card_if_exist();
        $errors = [];
        if($card){
            (new View("card_edit"))->show(array("card" => $card, "user" => $user, "errors" => $errors));
        }else{
            $this->redirect("board","index");
        }
    }

    public function save() {
        $user = $this->get_user_or_redirect();
        $card_id = "";
        $errors = [];
        if(isset($_POST["card_id"]) && isset($_POST["title"]) && isset($_POST["body"])){
            $card_id = $_POST["card_id"];
            $card = Card::get_card($card_id);
            $card->set_title($_POST["title"]);
            $card->set_body($_POST["body"]);
            $errors = $card->validate_title();
            if (count($errors) == 0) { 
                $card->update_content(); 
                $this->redirect("card","view", $card_id);
            }
            (new View("card_edit"))->show(array("card" => $card, "user" => $user, "errors" => $errors));
        }else{
            $this->redirect("board","index");
        }
    }
    
            
    public function move() {
        $test = $_POST["direction"];
        $id = $_POST["card_id"];
    }
        
    public function add() {
        $user = $this->get_user_or_redirect();
        $column_id = "";
        $errors = [];
        if(isset($_POST["column_id"]) && isset($_POST["title"])){
            $column_id = $_POST["column_id"];
            $column = Column::get_column($column_id);
            $board = Board::get_board($column->get_board_id());
            $position = Card::get_last_card_position_in_column($column_id) + 1;
            $card = new Card(null, $column, $position, $user, $_POST["title"], "", new DateTime("now"));
            $errors = $card->validate_title();
            if (count($errors) == 0) { 
                $card->insert_new_card(); 
                $this->redirect("board","board", $board->get_board_id());
            }
            (new View("board"))->show(array("board" => $board, "user" => $user, "errors" => $errors));
        }else{
            $this->redirect("board","index");
        }
    }

    public function delete_confirm() {
        $user = $this->get_user_or_redirect();
        $card = $this::get_card_if_exist();
        if($card){
            (new View("card_delete"))->show(array("card" => $card, "user" => $user));
        }else{
            $this->redirect("board","index");
        }
    }

    public function delete() {
        $user = $this->get_user_or_redirect();
        if(isset($_POST["card_id"])){
            $card = Card::get_card($_POST["card_id"]);
            $card->delete(); 
            $this->redirect("board","board", $card->get_board_id());
        }else{
            $this->redirect("board","index");
        }
    }

}

