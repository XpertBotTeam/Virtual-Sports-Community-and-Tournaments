@props(['league','foredit'])

<style>
.mainContainer{
    width: 50%;
    min-height: 80vh;
    margin: 45px 25%;
    background-color: var(--post-color);;
    border-radius: 12px;
}
 .mainContainer h1{
    color: white;
    text-align: center;
    font-size: 35px;
    font-weight: 800;
 }

 .form-container-tournCr {
    display: flex;
    align-items: center;
    flex-direction: column;
    width: 100%;
    margin-top: 5px;
    padding: 20px;
    border-radius: 12px;
    background: var(--hover-color);
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.199);
}
.form-container-tournCr span{
    font-size: 22px;
    color: white;
    font-weight: 700;
    width: 160px;
}
.form-container-tournCr input {
    border: none;
    border: solid rgb(143, 143, 143) 1px;
    background-color: white ;
    color: var(--hover-color);
    height: 35px;
    width: 300px;
    padding-left: 5px;
    font-size: 18px;
    font-weight: 600;
}
.form-container-tournCr div{
    display: flex;
    margin-bottom: 25px;
}
.form-container-tournCr .submitTourn {
    cursor: pointer;
    border: none;
    border-radius: 8px;
    box-shadow: 2px 2px 7px var(--background-color);
    transition: all 1s;
}

.form-container-tournCr .submitTourn:hover {
    color: white;
    background-color: var(--background-color);
    box-shadow: none;
}
select{
    width: 300px;
    height: 35px;
    font-size: 18px;
    font-weight: 600;
}
.errorslist{
    display: flex;
    margin-bottom: 25px;
    flex-direction: column;
    color: red;
    gap: 5px;
}

.errors{
    background-color: transparent;
    color: red;
    font-weight: bold;
    display: flex;
    margin-bottom: 25px;
    flex-direction: column;
    align-items: center;
}
</style>
<x-baselayout>
    <x-slot name="content">
        <div class="mainContainer">
        
        <div class="form-container-tournCr">
                @if($foredit)
                    <form  method="POST" id="createTournForm" action="../api/league/{{$league['id']}}/edit">
                    @csrf
                    @method('PUT')
                        <h1>
                        Create League
                        </h1>
                        <br>
                        <div class="nameInpt">   
                            <span>Name:</span>
                            <input type="text" name="name" value="{{$league['name']}}" >
                        </div>
                        <div>
                            <span>Description:</span>
                            <input type="text" name="description" value="{{$league['description']}}">
                        </div>
                        <div>
                            <span>Rewards:</span>
                            <input type="text" name="rewards" value="{{$league['rewards']}}">
                        </div>
                        <div>
                            <span>Requirements:</span>
                            <input type="text" name="requirements" value="{{$league['requirements']}}">
                        </div>
                        <div>
                            <span>Max Places:</span>
                            <input type="number" name="maxPlaces" value="{{$league['maxPlaces']}}">
                        </div>
                        <div>
                            <span>Sport Type:</span>
                            <select name="sportType">
                                <option value="fortnite">Fortnite</option>
                                <option value="dota">Dota</option>
                                <option value="CS">Counter Strike</option>
                                <option value="LOL">League Of Legends</option>
                                <option value="PUBG">PUBG</option>
                                <option value="apex">Apex Legend</option>
                                <option value="football">Football</option>
                                <option value="Overwatch">Overwatch</option>
                                <option value="fifa">FIFA 24</option>

                            </select>
                        </div>
                        <div>
                            <span>Type:</span>
                            <select name="type">
                                <option value="Friendly">Friendly</option>
                                <option value="Ranked">Ranked</option>
                            </select>
                        </div>
                        <div>
                            <span>Start Date:</span>
                            <input type="date" name="startDate" value="{{$league['startDate']}}">
                        </div>
                        <div>
                            <span>End Date:</span>
                            <input type="date" name="endDate" value="{{$league['endDate']}}">
                        </div>
                        <div>
                            <span>Duration:</span>
                            <input type="time" name="duration" value="{{$league['duration']}}">
                        </div>
                        <div>
                            <span>Time Left:</span>
                            <input type="time" name="timeLeft" value="{{$league['timeLeft']}}">
                        </div>     
                        
                        <div class="errors">
                      
                            @if(request()->session()->has('error'))

                            @auth   
                                @php

                                $errors=array(json_decode(session('error')[0]->original['errors']));
                                $error=$errors[0];
                                foreach($error as $er){
                                    foreach($er as $e){
                                    echo("<p>**$e</p>");}
                                }

                                session()->forget('error');
                                @endphp


                            @endauth
                      @endif

                  </div> 

                        <input type="submit" value="UPDATE" class="submitTourn" style="margin-left: 50%;transform: translateX(-50%);">
                    </form>
                @else
                    <form  method="POST" id="createTournForm" action="../api/league/user/{{auth()->user()->id}}">
                    @csrf
                        <h1>
                        Create League
                        </h1>
                        <br>
                        <div class="nameInpt">   
                            <span>Name:</span>
                            <input type="text" name="name" value="">
                        </div>
                        <div>
                            <span>Description:</span>
                            <input type="text" name="description" value="">
                        </div>
                        <div>
                            <span>Rewards:</span>
                            <input type="text" name="rewards" value="">
                        </div>
                        <div>
                            <span>Requirements:</span>
                            <input type="text" name="requirements" value="">
                        </div>
                        <div>
                            <span>Max Places:</span>
                            <input type="number" name="maxPlaces" value="">
                        </div>
                        <div>
                            <span>Sport Type:</span>
                            <select name="sportType">
                                <option value="fortnite">Fortnite</option>
                                <option value="dota">Dota</option>
                                <option value="CS">Counter Strike</option>
                                <option value="LOL">League Of Legends</option>
                                <option value="PUBG">PUBG</option>
                                <option value="apex">Apex Legend</option>
                                <option value="football">Football</option>
                                <option value="Overwatch">Overwatch</option>
                                <option value="fifa">FIFA 24</option>

                            </select>
                        </div>
                        <div>
                            <span>Start Date:</span>
                            <input type="date" name="startDate" value="">
                        </div>
                        <div>
                            <span>End Date:</span>
                            <input type="date" name="endDate" value="">
                        </div>
     
                       

                        <div class="errors">
                      
                        @if(request()->session()->has('error'))

                            @auth   
                                @php

                                $errors=array(json_decode(session('error')[0]->original['errors']));
                                $error=$errors[0];
                                foreach($error as $er){
                                    foreach($er as $e){
                                    echo("<p>**$e</p>");}
                                }

                                session()->forget('error');
                                @endphp


                            @endauth
                        @endif

                  </div> 

                        <input type="submit" value="SUBMIT" class="submitTourn" style="margin-left: 50%;transform: translateX(-50%);">
                    </form>
                @endif
                </div>
               
        
        </div>
        
    </x-slot>
</x-baselayout>
