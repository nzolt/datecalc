<?php


namespace App\Data;

use App\Data\Validator\InvaliDateException;

/**
 * Class DTOdateTime
 * @package App\Data
 */
class DTOdateTime
{
    protected $birthDate = '';
    protected $currentDate = '';
    protected $diffYears = 0;
    protected $diffDays = 0;
    protected $diffHours = 0;

    /**
     * DTOdateTime constructor.
     * @param string $date
     * @param string $format
     * @throws \Exception
     */
    public function __construct(string $date, string $format = 'Y-m-d H:i')
    {
        try{
            if(DateValidator::validateDate($date, $format)){
                $current = new \DateTime();
                $this->setCurrentDate($current->format($format));
                $birthDate = new \DateTime($date);
                $this->setBirthDate($birthDate->format($format));
                // Get dates difference
                $diff = $current->diff($birthDate);
                // Years
                $this->setDiffYears($diff->y);
                // Days
                $days = $diff->d;
                $days = $days + ($diff->y * 365);
                $this->setDiffDays($days);
                // Hours
                $hours = $diff->h;
                $hours = $hours + ($diff->days*24);
                $this->setDiffHours($hours);
            }
        } catch (InvaliDateException $e) {
            // TODO: Add logging
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getCurrentDate(): string
    {
        return $this->currentDate;
    }

    /**
     * @param string $currentDate
     */
    public function setCurrentDate(string $currentDate): void
    {
        $this->currentDate = $currentDate;
    }

    /**
     * @return int
     */
    public function getDiffYears(): int
    {
        return $this->diffYears;
    }

    /**
     * @param int $diffYears
     */
    public function setDiffYears(int $diffYears): void
    {
        $this->diffYears = $diffYears;
    }

    /**
     * @return int
     */
    public function getDiffDays(): int
    {
        return $this->diffDays;
    }

    /**
     * @param int $diffDays
     */
    public function setDiffDays(int $diffDays): void
    {
        $this->diffDays = $diffDays;
    }

    public function getHours()
    {
        return $this->getDiffHours();
    }

    /**
     * @return float
     */
    public function getDiffHours(): float
    {
        return $this->diffHours;
    }

    /**
     * @param int $diffHours
     */
    public function setDiffHours($hours): void
    {
        $this->diffHours = $hours;
    }

    /**
     * Class vars to Array
     * @return array
     */
    public function __toArray()
    {
        return [
            'Currentdate' => (string)$this->getCurrentDate(),
            'Birthdate' => (string)$this->getBirthDate(),
            'Years' => (string)$this->getDiffYears(),
            'Days' => (string)$this->getDiffDays(),
            'Hours' => (string)$this->getDiffHours(),
        ];
    }
}