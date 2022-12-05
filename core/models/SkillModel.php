<?php
class SkillModel extends Model
{

    function executeQuery(string $type)
    {
        // TODO: Implement executeQuery() method.
    }

    public function getSkillSet(): array
    {
        $sql = "SELECT * FROM `skill_set`";
        if ($stmt = mysqli_prepare($this->db_instance, $sql)) {
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $result = array();
                $num_row = mysqli_stmt_num_rows($stmt);
                while ($num_row >= 1) {
                    mysqli_stmt_bind_result($stmt, $skill_id, $skill_name);
                    if (mysqli_stmt_fetch($stmt)) {
                        $result[$skill_id] = $skill_name;
                    }
                    $num_row = $num_row - 1;
                }
                return $result;
            }
        }
        return [];
    }
}