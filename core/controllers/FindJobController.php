<?php
class FindJobController extends Controller
{

    function process($param)
    {
        // TODO: Implement process() method.
        header("HTTP/1.0 200");
        $this->header["title"] = "Find Job Page";
        $this->header["description"] = "Find a job";
        $action = array_shift($param);
        switch ($action)
        {
            case "":
                if($_SERVER["REQUEST_METHOD"] == "GET")
                {

                } else {
                    $this->view = "findJob";
                }
                break;
            default:
                break;

        }
    }
}