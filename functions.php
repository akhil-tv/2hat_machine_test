<?php
//$date - Y-m-d format
function getShippingDate($orderDate) {

    $orderTimeString = strtotime($orderDate);               // converting date object into string
    $timeOfOrder = date('H:i',$orderTimeString);     // getting time of order form the converted string

    /** to check the time of order if the time exceeded as per the configuration the system will add one more day and
     * the code will check the next suitable date for the delivery
     **/
    if ($timeOfOrder < CUTOFF_TIME){
        $possibleShippingDay = calculateShippingDate($orderTimeString);
    }else{
        $possibleShippingDay = calculateShippingDate( strtotime('+1 day', $orderTimeString));
    }

    return $possibleShippingDay;
}

// actual logic for the calculation lies in this function
function calculateShippingDate($orderTimeString)
{
    // getting the week of the order date from the converted string
    while (in_array( date('l',$orderTimeString),HOLIDAYS)){
        $orderTimeString = strtotime('+1 day', $orderTimeString);
    }
    return date('Y-m-d',$orderTimeString);
}

