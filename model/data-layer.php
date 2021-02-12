<?php

/**getEthnicities()
 * returns an array of ethnicities used in forms
 * @return string[]
 */
function getEthnicities()
{
    $ethnicities = array('African (Native)','African American','Asian','Caucasian','Eskimo',
        'Latinx','Mixed','Native','Pacific Islander','Other','Prefer not to answer' );
    return $ethnicities;
}

/**getResources()
 * returns an array of types of help provided
 * @return string[]
 */
function getResources()
{
    $resources = array('Dol','Energy Bill','Food','Gas','Rent','Thrift Shop',
        'Water','Other');
    return $resources;
}

/**getGenders()
 * returns an array of gender options to be used in form
 * @return string[]
 */
function getGenders()
{
    $genders = array('Male','Female','Other','Prefer not to answer');
    return $genders;
}