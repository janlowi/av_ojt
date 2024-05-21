<?php
inlcude ' ';


public function fetch()
    {
        $data = [];

        $query = "SELECT * FROM student";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function date_range($start_date, $end_date)
    {
        $data = [];

        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT * FROM `student` WHERE `created_at` > '$start_date' AND `created_at` < '$end_date'";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }

        return $data;
    }

?>