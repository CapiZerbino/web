<?php
class AllJobController extends Controller
{

    function process($param)
    {
        // TODO: Implement process() method.
        header("HTTP/1.0 200");
        $this->header["title"] = "All Job Page";
        $this->header["description"] = "All job";
        $action = array_shift($param);
        switch ($action)
        {
            case "":
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
                    $company = new CompanyModel();
                    $company->loadQuery($_GET["search"]);
                    $company->executeQuery("SearchCompany");
                    $res = $company->getResponse();
                    if(!empty($res["result"]))
                    {
                        $_SESSION["result"] = $res["result"];
                    } else {
                        $_SESSION["message"] = "Cannot found company";
                    }
                }
                $this->view = "findCompany";
                break;
            default:
                $this->redirect("error");
        }
    }
}