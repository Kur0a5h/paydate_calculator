<?php /* ~(˘▾˘~) Good Luck (~˘▾˘)~ */

namespace DevXyz\Challenge\KuroashEsmaili;

include 'PaydateCalculatorInterface.php';

use DevXyz\Challenge\PaydateCalculatorInterface;

class PaydateCalculator implements PaydateCalculatorInterface
{
    public $paydateOne;
    public $numberOfPaydates;
    public $paydateModel;
    
    public $unit = null;
    public $count = null;
    public $paydates = array ();
      
    public function __construct( $paydateOne, $numberOfPaydates, $paydateModel ) {
        $this->$paydateOne = $paydateOne;
        $this->$numberOfPaydates = $numberOfPaydates;
        $this->$paydateModel = $paydateModel;
        date_default_timezone_set('America/Los_Angeles');
        echo ($paydateModel);
    }
    /**
     * takes a paydate model and first paydate and generates the next $numberOfPaydates paydates.
     *
     * @param string $paydateModel The paydate model, one of the items in the spec
     * @param string $paydateOne First paydate as a string in Y-m-d format, different from the second
     * @param int $numberOfPaydates The number of paydates to generate
     *
     * @throws \InvalidArgumentException
     *
     * @return array the next paydates (from today) as strings in Y-m-d format
     */
    public function calculateNextPaydates($paydateModel, $paydateOne, $numberOfPaydates){

        if(!$this->isValidDate($paydateOne)){
            throw new \Exception("Date must be in Y-m-d format.");
        }
       
        $numberOfPaydates = (int) $numberOfPaydates;

        if ($numberOfPaydates <= 0) {
            throw new \Exception("Number of dates must be greater than 0");
        }

        $this->setModelDelta($paydateModel);

        $paydates[] = $paydateOne;

        for( $i = 1 ; $i < $numberOfPaydates ; $i++ ){
            $paydates[] = $this->increaseDate( $paydateOne, $count, $unit );
        }

        return $paydates;

    }

    /**
     * determines whether a given date in Y-m-d format is a holiday.
     *
     * @param string $date A date as a string formatted as Y-m-d
     *
     * @return bool whether or not the given date is on a holiday
     */
    public function isHoliday($date){

        $holidays = [
            '2019-01-01',
            '2019-02-17',
            '2019-05-26',
            '2019-07-04',
            '2019-09-01',
            '2019-10-13',
            '2019-11-11',
            '2019-11-27',
            '2019-12-25',
            '2020-01-01',
            '2020-01-19',
            '2020-02-16',
            '2020-05-25',
            '2020-07-03',
            '2020-09-07',
            '2020-10-12',
            '2020-11-11',
            '2020-11-26',
            '2020-12-25'
        ];

        if ($holidays.includes($date)){
        return true;
        }
        return false;
    }

    /**
     * determines whether a given date in Y-m-d format is on a weekend.
     *
     * @param string $date A date as a string formatted as Y-m-d
     *
     * @return bool whether or not the given date is on a weekend
     */
    public function isWeekend($date){

        $dayOfTheWeek = date('N', strtotime($date));

        if ( $dayOfTheWeek === 6 || $dayOfTheWeek === 7){

            return true;
        }

        return false;
    }

    /**
     * determines whether a given date in Y-m-d format is a valid paydate according to specification rules.
     *
     * @param string $date A date as a string formatted as Y-m-d
     *
     * @return bool whether or not the given date is a valid paydate
     */
    public function isValidPaydate($date){
        if(!isValidDate($date))
        if(!$this->isHoliday($date)){
            return false;
        }
        if(!$this->isWeekend($date)){
            return false;
        }

        return true;
    }

    /**
     * increases a given date in Y-m-d format by $count $units
     *
     * @param string $date A date as a string formatted as Y-m-d
     * @param integer $count The amount of units to increment
     * @param string $unit adjustment unit
     *
     * @return string the calculated day's date as a string in Y-m-d format
     */
    public function increaseDate($date, $count, $unit = 'days'){
        
        switch($unit){
            case 'months':
                $dateA = clone($date);
                $dateB = clone($date);
                $plusMonth = clone($dateA->modify("+{$count} month"));
                if($dateB != $dateA->modify("-{$count} month")){
                    $result = $plusMonth->modify('last day of last month');
                } elseif($aDate == $dateB->modify('last day of this month')){
                    $result =  $plusMonth->modify('last day of this month');
                } else {
                    $result = $plusMonth;
                }
                return $result;
            case 'days':
                return $date->modify("+{$count} {$unit}");
        }
        
    }

    /**
     * decreases a given date in Y-m-d format by $count $units
     *
     * @param string $date A date as a string formatted as Y-m-d
     * @param integer $count The amount of units to decrement
     * @param string $unit adjustment unit
     *
     * @return string the calculated day's date as a string in Y-m-d format
     */
    public function decreaseDate($date, $count, $unit = 'days'){
        switch($unit){
            case 'months':
                $dateA = clone($date);
                $dateB = clone($date);
                $minusMonth = clone($dateA->modify("-{$count} month"));
                if($dateB != $dateA->modify("+{$count} month")){ 
                    $result = $minusMonth->modify('last day of  month');
                } elseif($aDate == $dateB->modify('last day of this month')){
                    $result =  $minusMonth->modify('last day of this month');
                } else {
                    $result = $minusMonth;
                }
                return $result;
            case 'days':
                return $date->modify("-{$count} {$unit}");
        }
    }
    /**
     * @param string $date
     * @return bool whether or not the given date string is an actual valid date
     */
    public function isValidDate($date){
        return (bool)strtotime($date);
    }

    /**
     * returns a first available paydate that comes after the given date
     *
     * @param string $date
     * @return string
     */
    public function getFirstPaydateAfter($date){
        
            foreach($paydates as $day)
            {
                $intervals[] = abs(strtotime($date) - strtotime($day));
            }

            for( $interval=0 ; $interval < sizeof( $intervals ); $interval++ ){
                if($intervals[$interval] >= 0) return $paydates[$interval];
            }
            
    }
    

    public function setModelDelta($paydateModel){

        switch($paydateModel){
            case 'Weekly':
                $this->$unit="days";
                $this->count=7; 
                break;
            case 'Bi-Weekly':
                $this->$unit = 'days';
                $this->$count = 14;
                break;
            case 'Monthly':
                $this->$unit = 'months';
                $this->$count = 1;
                break;
        }
    }
}