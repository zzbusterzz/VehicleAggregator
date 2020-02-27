{{-- @php( ) --}}
<?php   
        $services = \App\Service::all();
        $showState = true;
        $showCity = false;
        $showBookings = false;

        $states;
        $cities;
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

   </head>
   <body id="main_body" >
      <b>Dashboard</b>
      <img id="top" src="top.png" alt="">
      <div id="form_container">
      <form id="form_100455" class="appnitro"   action="">
         <div class="form_description">
         </div>
         <label class="description" for="element_2">Choose the service which you require available in above location : </label>
         <div>
            <select class="service" id="element_2" name="Service" onchange="UpdateState(this);">
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach   
            </select>
         </div>
         {{-- @php( $select = DB::select('select * from student')) --}}

         @if ($showState)
            <label class="State" for="element_3">State </label>
            <div>
                <select class="State" id="element_3" name="State">
                @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach  
                </select>
            </div>
            </li>
            <label class="description" for="element_4">City </label>
            <div>
                <select class="City" id="element_4" name="City">
                <option value="" selected="selected"></option>
                <option value="1" >First option</option>
                <option value="2" >Second option</option>
                <option value="3" >Third option</option>
                </select>
            </div>
            <label class="description" for="element_1">Locality </label>
            <div>
                <input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/> 
            </div>
            <label class="description" for="element_5">Service Providers </label>
            <div>
                <select class="element select medium" id="element_5" name="element_5">
                <option value="" selected="selected"></option>
                <option value="1" >First option</option>
                <option value="2" >Second option</option>
                <option value="3" >Third option</option>
                </select>
            </div>
            <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
        @endif 
       
      </form>

      
      <div id="form_container" class="bookVehicle" style="display:none">
         <form id="form_100455" class="appnitro"  method="post" action="">
            <div class="form_description">
               <h2>Appointment Selection</h2>
               <p></p>
            </div>

            <ul >
                <li id="li_0" >
                    <label for="birthday">Appointment Date:</label>
                    <input type="date" id="aptDate" name="aptDate"> 
                </li>
               <li id="li_1" >
                  <label class="description" for="element_1">Appointment Time </label>
                  <span>
                  <input id="element_1_1" name="element_1_1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                  <label>HH</label>
                  </span>
                  <span>
                  <input id="element_1_2" name="element_1_2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                  <label>MM</label>
                  </span>
                  <span>
                  <input id="element_1_3" name="element_1_3" class="element text " size="2" type="text" maxlength="2" value=""/>
                  <label>SS</label>
                  </span>
                  <span>
                     <select class="element select" style="width:4em" id="element_1_4" name="element_1_4">
                        <option value="AM" >AM</option>
                        <option value="PM" >PM</option>
                     </select>
                     <label>AM/PM</label>
                  </span>
               </li>
               <li id="li_2" >
                  <label class="description" for="element_2">Vehicle Reg No: </label>
                  <div>
                     <input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value=""/> 
                  </div>
               </li>
               <li id="li_4" >
                  <label class="description" for="element_4">Brand Name </label>
                  <div>
                     <select class="element select medium" id="element_4" name="element_4">
                        <option value="" selected="selected"></option>
                        <option value="1" >First option</option>
                        <option value="2" >Second option</option>
                        <option value="3" >Third option</option>
                     </select>
                  </div>
               </li>
               <li id="li_5" >
                  <label class="description" for="element_5">Brand Model </label>
                  <div>
                     <select class="element select medium" id="element_5" name="element_5">
                        <option value="" selected="selected"></option>
                        <option value="1" >First option</option>
                        <option value="2" >Second option</option>
                        <option value="3" >Third option</option>
                     </select>
                  </div>
               </li>
               <li id="li_3" >
                  <label class="description" for="element_3">Year of Mfg </label>
                  <div>
                     <input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value=""/> 
                  </div>
               </li>
               <li class="buttons">
                  <input type="hidden" name="form_id" value="100455" />
                  <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
               </li>
            </ul>
         </form>
      </div>

   </body>
</html>

<script>
function UpdateState(sel)
{
    this->$State = 
}
</script>