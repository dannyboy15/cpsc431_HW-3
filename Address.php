 <?php

require_once("sanitize.php");

class Address {
  // Instance attributes
  private $name         = array('FIRST'=>"", 'LAST'=>null); 
  private $street       = "";
  private $city         = "";
  private $state        = "";
  private $country      = "";
  private $zip          = 0;

  // Operations

  // name() prototypes:
  //   string name()                          returns name in "Last,First" format.
  //                                          If no first name assigned, then return in "Last" format.
  //                                         
  //   void name(string $value)               set object's $name attribute in "Last, First" 
  //                                          or "Last" format.
  //                                         
  //   void name(array $value)                set object's $name attribute in [first, last] format
  //
  //   void name(string $first, string $last) set object's $name attribute
  function name() {
    // string name()
    if( func_num_args() == 0 ) {
      if( empty($this->name['FIRST']) ) return $this->name['LAST'];
      else return $this->name['LAST'].', '.$this->name['FIRST']; 
    }
   
    // void name($value)
    else if( func_num_args() == 1 ) {
      $value = func_get_arg(0);
      sanitize($value);
     
      if( is_string($value) ) {
        $value = explode(',', $value); // convert string to array 
       
        if ( count($value) >= 2 ) $this->name['FIRST'] = $value[1];
        else                      $this->name['FIRST'] = '';
       
        $this->name['LAST']  = htmlspecialchars(trim($value[0]));          
      }
     
      else if( is_array ($value) ) {
        if ( count($value) >= 2 ) $this->name['LAST'] = $value[1];
        else                      $this->name['LAST'] = '';

        $this->name['FIRST']  = $value[0]; 
      }
    }

    // void name($first_name, $last_name)
    else if( func_num_args() == 2 ) {
      $this->name['FIRST'] = sanitze(func_get_arg(0));
      $this->name['LAST']  = sanitze(func_get_arg(1)); 
    }

    return $this;
  }




  // street() prototypes:
  //   string street()                          returns the street name.
  //                                         
  //   void street(string $value)               set object's $street attribute.
  function street() {  
    // string street()
    if( func_num_args() == 0 ) {
      return $this->street;
    }

    // void street($value)
    else if( func_num_args() == 1 ) {
      $this->street = (string) sanitize(func_get_arg(0));
    }
  
    return $this;
  }


  // city() prototypes:
  //   string city()               returns the city name.
  //                                         
  //   void city(string $value)    set object's $city attribute
  function city() {  
    // string city()
    if( func_num_args() == 0 ) {
      return $this->city;
    }

    // void city($value)
    else if( func_num_args() == 1 ) {
      $this->city = (string) sanitize(func_get_arg(0));
    }

    return $this;
  }


  // state() prototypes:
  //   string state()               returns the name of the state.
  //                                         
  //   void state(string $value)    set object's $state attribute
  function state() {  
    // string state()
    if( func_num_args() == 0 ) {
      return $this->state;
    }

    // void state($value)
    else if( func_num_args() == 1 ) {
      $this->state = (string) sanitize(func_get_arg(0));
    }

    return $this;
  }


  // country() prototypes:
  //   string country()               returns the name of the country.
  //                                         
  //   void country(string $value)    set object's $country attribute
  function country() {  
    // string country()
    if( func_num_args() == 0 ) {
      return $this->country;
    }

    // void country($value)
    else if( func_num_args() == 1 ) {
      $this->country = (string) sanitize(func_get_arg(0));
    }

    return $this;
  }


  // zip() prototypes:
  //   int zip()               returns the zip code.
  //                                         
  //   void zip(int $value)    set object's $zip attribute
  function zip() {  
    // int zip()
    if( func_num_args() == 0 ) {
      return $this->zip;
    }

    // void zip($value)
    else if( func_num_args() == 1 ) {
      $this->zip = (int)func_get_arg(0);
    }

    return $this;
  }


  function __construct($name="", $street="", $city="", $state="", $country="", $zip=0) {
    // if $name contains at least one tab character, assume all attributes are provided in 
    // a tab separated list.  Otherwise assume $name is just the player's name.

    // Note, can't check for "true" because strpos() only returns the boolean value "false", never "true"
    // if( strpos($name, "\t") !== false) {
    //   // assign each argument a value from the tab delineated string respecting relative positions
    //   list($name, $street, $city, $state, $zip) = explode("\t", $name);
    // }

    // delegate setting attributes so validation logic is applied
    $this->name($name);
    $this->street($street);
    $this->city($city);
    $this->state($state);
    $this->country($country);
    $this->zip($zip);
  }

  function __toString() {
    return (var_export($this, true));
  }


  // Returns a tab separated value (TSV) string containing the contents of all instance attributes   
  function toTSV() {
    return implode("\t", [$this->name(), $this->street(), $this->city(),
      $this->state(), $this->zip()]);
  }


  // Sets instance attributes to the contents of a string containing ordered, tab separated values 
  function fromTSV(string $tsvString) {
    // assign each argument a value from the tab delineated string respecting relative positions
    list($name, $street, $city, $state, $zip) = explode("\t", $tsvString);
    $this->name($name);
    $this->street($street);
    $this->city($city);
    $this->state($state);
    $this->zip($zip);
  }
} // end class Address

?>