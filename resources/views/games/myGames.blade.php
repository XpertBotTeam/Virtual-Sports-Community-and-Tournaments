<style>
    .mainContainer{
        min-height: 80vh;
        background-color: #191919;
        border-radius: 12px;
        margin: 45px 165px;
        padding: 15px 15px;
    }
    .nk-breadcrumbs{
        font-family: "Montserrat", sans-serif;
        font-style: normal;
        font-weight: 700;
        padding: 0;
        margin: 0;
        color: #fff;
        text-transform: uppercase;
        list-style-type: none;
        margin-bottom: 40px;
    }
    .nk-breadcrumbs > li{
        display: inline-block;
    font-size: 1.07rem;
    }
    .nk-breadcrumbs > li + li {
    margin-left: 6px;
    }
    .nk-breadcrumbs > li:last-of-type {
    display: flex;
    margin-top: 9px;
    margin-left: 0;
    font-size: 18px;
    gap: 10px;
}
.svg-inline--fa {
    display: var(--fa-display,inline-block);
    height: 1em;
    overflow: visible;
    vertical-align: -0.125em;
}
.nk-breadcrumbs > li:last-of-type::after {
    content: "";
    display: block;
    -webkit-box-flex: 100;
    -ms-flex: 100;
    flex: 100;
    border-bottom: 4px solid white;
    -webkit-transform: translateY(-12px);
    -ms-transform: translateY(-12px);
    transform: translateY(-12px);
    margin-bottom: -3px;
}
.svg-inline--fa {
    display: var(--fa-display,inline-block);
    height: 1em;
    overflow: visible;
    vertical-align: -0.125em;
}
.nk-breadcrumbs > li:last-of-type::after {
    content: "";
    display: block;
    -webkit-box-flex: 100;
    -ms-flex: 100;
    flex: 100;
    border-bottom: 4px solid white;
    -webkit-transform: translateY(-12px);
    -ms-transform: translateY(-12px);
    transform: translateY(-12px);
    margin-bottom: -3px;
}
.gamesInfo{
    width: 100%;
    min-height: 50vh;
    display: flex;
    gap: 25px;
}
.gamesInfo .gamesList{
    
    width: 65%;
    display: flex;
    
    flex-wrap: wrap;
    gap: 20px;

}

.sideContainer{
    width: 35%;
    height: fit-content;
    padding: 20px 23px ;
    background-color: var(--background-color);
}
h4{
    
    margin-bottom: 0;
    
    font-size: 1.22rem;
    text-transform: uppercase;
    font-family: Montserrat, sans-serif;
    font-style: normal;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
    position: relative;
    z-index: 1;
}
h4 span{
    display: inline-block;
    padding-right: 18px;
    background-color: var(--background-color);
}
h4::after{
    
    display: block;
    top: 36px;
    right: 1px;
    left: 30px;
    height: 3px;
    background-color: #fff;
    z-index: -1;
}
.noGame{
    width: 65%;
}
.noGame h3{
    color: white;
    font-size: 30px;
    text-align: center;
}
</style>
@php

use App\Models\Posts;
use App\Models\User;

use App\Models\Tournaments;
use App\Models\Games;

$myTournGames=User::find(auth()->user()?->id)->tournaments;

$games=array();

for($i=0;$i < count($myTournGames) ; $i++){
    $tournGames=Tournaments::find($myTournGames[$i]->tournament_id)->games;
    
    for($j = 0;$j < count($tournGames);$j++){
        if($tournGames[$j]->firstUserName == auth()->user()->name  || $tournGames[$j]->secondUserName == auth()->user()->name ){
            array_push($games,$tournGames[$j]);
        }
    }

    
};

$firstSide=Posts::find(31);
$secondSide=Posts::find(35);
$thirdSide=Posts::find(36);

@endphp


<x-baselayout>
    <x-slot name="content">
        <div class="mainContainer">
            <ul class="nk-breadcrumbs">
                <li><a rel="v:url" href="/">Home</a></li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>          
                <li><a rel="v:url" href="../tournament/tops">Tournaments</a></li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>          
                <li><span><h1>My Games</h1></span></li>
            </ul>
            <div class="gamesInfo">
                @if(count($games)==0)
                    <div class="noGame">
                        <h3>You Dont Have Any Games.</h3>
                    </div>
                @else   
                    <div class="gamesList">                                                                 
                        @for($i = 0; $i<count($games);$i++)
                            @if($games[$i]["competetionType"] == "Tournament")
                                <x-gameSummary :tournGame='$games[$i]' :leagueGame="null"></x-gameSummary>
                            @else
                            <x-gameSummary :tournGame='null' :leagueGame="$games[$i]"></x-gameSummary>
                            @endif
                        @endfor
                    </div>
                @endif

                <div class="sideContainer">
                    <h4 class="nk-widget-title"><span>Top 3 Recent</span></h4>
                    <ul>
                        <x-sidePost :firstSide='$firstSide'></x-sidePost>
                        <x-sidePost :firstSide='$secondSide'></x-sidePost>
                        <x-sidePost :firstSide='$thirdSide'></x-sidePost>
                    </ul>
                </div>
            </div>
           
            
        </div>
        @if(request()->session()->has('response'))
                
                <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                    <p   class="responseContent success">{{session('response')[0]->original['message']}}</p>   
                    @php
                    session()->forget('response');
                    @endphp
                </div>
            @endif
    
            @if(request()->session()->has('error'))
                  <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                      <p   class="responseContent error">{{session('error')[0]->original['errors']}}</p> 
                      @php
                        session()->forget('error');
                    @endphp
                  </div>
            @endif
    </x-slot>
</x-baselayout>