<?php


class Crud_controller extends CI_Controller
{


    public function send_add_data()
    {
        $config["allowed_types"] = "gif|png|jpg";
        $config["encrypt_name"] = TRUE;
        $this->load->database();
        $this->load->library("upload", $config);
        $base64_image = "";
        if (!empty($_FILES['image']['tmp_name'])) {
            $image_data = file_get_contents($_FILES['image']['tmp_name']);
            $base64_image = base64_encode($image_data);
        }
        $data = array(
            "title" => $this->input->post("title"),
            "image" => $base64_image,
            "language" => $this->input->post("languages"),
            "status" => $this->input->post("status"),



        );
        $this->load->model("Crud_model");
        $result = $this->Crud_model->send_add_data($data);
        if ($result) {
            echo json_encode("data added successfully");
        } else {
            echo json_encode("data not added succesfully");
        }
    }
    public function fetch_update_data()
    {
        $id = $this->input->post("id");

        $this->load->model("Crud_model");
        $result = $this->Crud_model->fetch_update_model($id);

        $output = [];
        foreach ($result as $row) {
            $sub_array = [];
            $sub_array["title"] = $row->title;
            $sub_array["image"] = '<img id="dynamic" height="100px" width="150px"  src="data:image/jpg|png|jpeg;base64,' . $row->image . '" />';
            $sub_array["language"] = $row->language;
            $sub_array["status"] = $row->status;
            $sub_array["base64"] = $row->image;
            $output[] = $sub_array;
        };
        echo json_encode($output);
    }
    public function send_update_data()
    {  $config["allowed_types"] = "gif|png|jpg";
        $config["encrypt_name"] = TRUE;
        $this->load->database();
        $this->load->library("upload", $config);
        $base64_image = "";
        if (!empty($_FILES['imageupdate']['tmp_name'])) {
            $image_data = file_get_contents($_FILES['image']['tmp_name']);
            $base64_image = base64_encode($image_data);
        }
        $data=array(
            "title"=>$this->input->post("titleupdate"),
            "image"=>$h





        )
        
    }
}
