<?php

class FlightsController
{
    public function getAllFlights()
    {
        $flights = Flights::getAll();
        return $flights;
    }

    public static function getOneFlights()
    {
        if (isset($_POST['id'])) {
            $data = array(
                'id' => $_POST['id']
            );
            $flight = Flights::getFlights($data);
            $date_spaced = explode(" ", $flight->date_time);
            $flight->date_time = $date_spaced[0] . "T" . $date_spaced[1];
            $date_spaced = explode(" ", $flight->arrive_time);
            $flight->arrive_time = $date_spaced[0] . "T" . $date_spaced[1];
            // echo $flight->date_time;
            // die();
            return $flight;
        }
    }

    public function findFlights()
    {
        if (isset($_POST['search'])) {
            $data = array('search' => $_POST['search']);
        }
        $flight = Flights::searchFlights($data);
        return $flight;
    }

    // public function updateFlights(){
    //     if(isset($_POST['submit'])){
    //       $data = array(
    //           'id' => $_POST['id'],
    //           'depart' => $_POST['depart'],
    //           'destination' => $_POST['destination'],
    //           'price' => $_POST['price'],
    //           'seat_number' => $_POST['seat_number'],
    //       );
    //       $result = Flights::update($data);
    //       if($result === 'ok'){
    //         Session::set('success','modified flight');
    //         Redirect::to('home');
    //       }else{
    //           echo $result;
    //       }
    //     }
    // }

    public function updateFlights()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'id' => $_POST['id'],
                'fro_m' => $_POST['from'],
                'to' => $_POST['to'],
                'date_time' => $_POST['date_tim'],
                'arrive_time' => $_POST['arrive_time'],
                'price' => $_POST['price'],
                'seats_number' => $_POST['seats'],
                'status' => $_POST['status']
            );
            $result = Flights::update($data);
            if ($result === 'ok') {
                Session::set('success', 'The flight has been edited');
                Redirect::to('home');
            } else {
                echo $result;
            }
        }
    }


    // public function addFlights(){
    //     if(isset($_POST['submit'])){
    //       $data = array(
    //           'depart' => $_POST['depart'],
    //           'destination' => $_POST['destination'],
    //           'price' => $_POST['price'],
    //           'seat_number' => $_POST['seat_number'],
    //       );
    //       $result = Flights::add($data);
    //       if($result === 'ok'){
    //           Session::set('success','flight added');
    //           Redirect::to('home');
    //       }else{
    //           echo $result;
    //       }
    //     }
    // }

    public function getpassengers()
    {
        if (isset($_POST['id'])) {
            $data = array('id' => $_POST['id']); // $_POST['id'] is the id of the vol
            $passengers = Flights::getpassengers($data); // $ gains access to method getpassengers and vol class
            return $passengers;
        }
    }
    public function addFlights()
    {  //add function
        // echo $_POST['date_tim'];
        // die();
        if (isset($_POST['submit'])) {
            $data = array(
                'fro_m' => $_POST['from'],
                'to' => $_POST['to'],
                'date_time' => $_POST['date_tim'],
                'arrive_time' => $_POST['arrive_time'],
                'price' => $_POST['price'],
                'seats_number' => $_POST['seats'],
                'status' => $_POST['status']
            );
            $result = Flights::add($data);
            if ($result === 'ok') {
                Session::set('success', 'The flight has been added');
                Redirect::to('home');
            } else {
                echo $result;
            }
        }
    }

    public function deleteFlights()
    {
        if (isset($_POST['id'])) {
            $data['id'] = $_POST['id'];
            $result = Flights::delete($data);
            if ($result === 'ok') {
                Session::set('success', 'deleted flight');
                Redirect::to('home');
            } else {
                echo $result;
            }
        }
    }
    // public function deleteFlight(){
    //     if (isset($_POST['delete'])){
    //         $id = $_POST['id_vol'];
    //         // echo " test delete $id";
    //         $this->flightModel->deleteFlight($id);
    //     }
    //     header("location:" . URLROOT ."flights/index");
    //  }

    public function addBook()
    {
        $data = array(
            'id' => $_POST['id']
        );
        Book::add($data);
        Flights::decrease($data['id']);
        Session::set('success', 'successfully booked');
    }
    public function deleteBook()
    {
        $data = array(
            'id' => $_POST['id']
        );


        Book::delete($data);
        Session::set('success', 'successfully deleted');
    }

    public function getBook()
    {
        $data = Book::getAll();
        return $data;
    }

    public function getAllBook()
    {
        $data = Book::getAllflights();
        return $data;
    }

    public function addPassenger()
    {
        if (isset($_POST['addpass'])) { // if the button is clicked
            // echo '<pre>';
            // print_r($_POST);
            // die;

            $data = array(  // data to be inserted
                'id_users' => $_SESSION['id'], 
                'id_flight' => $_POST['id_flight'], 
                'fullname' => $_POST['fullname'], 
                'birthday' => $_POST['birthday'],
            );
       
            $result = Flights::addpass($data);
            if ($result === 'ok') {
                Session::set('success', 'Passenger added');
                Redirect::to('showflights');
            } else {
                echo $result;
            }
        }
    }
}
