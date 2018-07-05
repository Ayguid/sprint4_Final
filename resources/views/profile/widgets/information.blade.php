


<div class="panel panel-default">
    <div class="panel-heading">Relaciones @if($my_profile) <a href="javascript:;" data-toggle="modal" data-target="#profileRelationship"><i>{{ 'Nueva' }}</i></a> @endif</div>

    <ul class="list-group" style="max-height: 300px; overflow-x: auto">
        @if($relationship->count() == 0 && $relationship2->count() == 0)
            <li class="list-group-item">Sin relaciones!</li>
        @endif
        @if($relationship->count() > 0)
            @foreach($relationship as $relative)
                <li class="list-group-item">
                    @if($user->sex == 0){{ 'Su' }}@else{{ 'Su' }}@endif {{ $relative->getType() }} es <a href="{{ url('/'.$relative->relative->username) }}">{{ $relative->relative->name }}</a>
                    @if($my_profile)
                    <a href="javascript:;" onclick="removeRelation(0, {{ $relative->id }})" class="pull-right"><i class="fa fa-times"></i></a>
                    @endif
                </li>
            @endforeach
        @endif
        @if($relationship2->count() > 0)
            @foreach($relationship2 as $relative)
                <li class="list-group-item">
                    {{ $relative->getType() }} de  <a href="{{ url('/'.$relative->main->username) }}">{{ $relative->main->name }}</a>
                    @if($my_profile)
                    <a href="javascript:;" onclick="removeRelation(1, {{ $relative->id }})" class="pull-right"><i class="fa fa-times"></i></a>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</div>



<div class="panel panel-default">

    <div class="panel-heading">Hobbies @if($my_profile) <a href="javascript:;" data-toggle="modal" data-target="#profileHobbies"><i>{{ 'Editar' }}</i></a> @endif</div>

    <ul class="list-group" style="max-height: 300px; overflow-x: auto">
        @if($user->hobbies()->count() == 0)
            <li class="list-group-item">Sin Hobbies!</li>
        @else
            @foreach($user->hobbies()->get() as $hobby)
                <li class="list-group-item">{{ $hobby->hobby->name }}</li>
            @endforeach
        @endif
    </ul>


</div>



@if($my_profile)
<div class="modal fade" id="profileInformation" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Tu informacion</h5>
            </div>

            <div class="modal-body">
                <form id="form-profile-information">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Genero</label>
                                <select class="form-control " name="sex">
                                    <option value="0" @if($user->sex == 0){{ 'selected' }}@endif>Male</option>
                                    <option value="1" @if($user->sex == 1){{ 'selected' }}@endif>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cumple</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-birthday-cake"></i></span>
                                    <input type="text" class="form-control datepicker" name="birthday" value="@if($user->birthday){{ $user->birthday->format('Y-m-d') }}@endif" aria-describedby="basic-addon1" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tel:</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-mobile"></i></span>
                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control">{{ $user->bio }}</textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="saveInformation()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





{{--  --}}
<div class="modal fade" id="profileHobbies" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Tus Hobbies</h5>
            </div>
            <form id="form-profile-hobbies" method="post" action="{{ url('/'.$user->username.'/save/hobbies') }}">

                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="form-group">
                        <label>Hobbies:</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select class="form-control select2-multiple" name="hobbies[]" multiple="multiple" style="width: 100%">
                                    @foreach($hobbies as $hobby)
                                        <option value="{{ $hobby->id }}" @if($user->hasHobby($hobby->id)){{ 'selected' }}@endif>{{ $hobby->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>

</div>

{{--  --}}













<div class="modal fade" id="profileRelationship" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Nueva relacion</h5>
            </div>
            <form id="form-profile-hobbies" method="post" action="{{ url('/'.$user->username.'/save/relationship') }}">

                {{ csrf_field() }}



                <div class="modal-body">

                    @if($user->messagePeopleList()->count() == 0)
                        No tenes a nadie que te siga, un bajon
                    @else

                    <div class="form-group">
                        <label>Persona:</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select class="form-control" name="person" style="width: 100%">
                                    @foreach($user->messagePeopleList()->get() as $fr)
                                        <option value="{{ $fr->follower->id }}">{{ $fr->follower->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Relacion:</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select class="form-control" name="relation" style="width: 100%">
                                    <option value="0">Amigo</option>
                                    <option value="1">Mejor Amigo</option>
                                    <option value="2">Familiar</option>
                                    <option value="3">No me caes bien</option>
                                    <option value="4">Chongo/a</option>
                                    <option value="5">Conocido</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    @endif

                </div>

                <div class="modal-footer">
                    @if($user->messagePeopleList()->count() > 0)
                    <button type="submit" class="btn btn-success">Save</button>
                    @endif
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endif
