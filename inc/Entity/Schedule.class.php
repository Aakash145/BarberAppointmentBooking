<?php
class Schedule
{

    private $user_id;
    private $shift_id;
    private $start_date_time;
    private $end_date_time;

    public function getUserId()
    {
        return $this->user_id;
    }
    public function getStartDate()
    {
        return $this->start_date_time;
    }
    public function getEndDate()
    {
        return $this->end_date_time;
    }
    public function getShiftId()
    {
        return $this->shift_id;
    }
    
    public function setUserId(int $id)
    {
        $this->user_id = $id;
    }
    public function setShiftId(int $id)
    {
        $this->shift_id = $id;
    }
    public function setStartDate(DateTime $time)
    {
        $this->start_date_time = $time;
    }
    public function setEndDate(DateTime $time2)
    {
        $this->end_date_time = $time2;
    }
}
?>