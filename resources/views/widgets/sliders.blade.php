
@php
$pieces=null;
if (Auth::user()->bio) {
  $rgb=Auth::user()->bio;
  $pieces = explode(",",$rgb);
}
// if (isset($_POST['redSlider'])) {
//   Auth::user()->bio = $_POST['redSlider'].','.$_POST['greenSlider'].','.$_POST['blueSlider'];
//   Auth::user()->save();
//
// }
@endphp




<div class="sliders">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings') }}">
      {{ csrf_field() }}
<label for="red" color="red">
Rojo
</label>
<input id="red" type="range" name="redSlider" value="<?=($pieces)?$pieces[0]:'255'?>" min="0" max="255"  onchange = "changeBackground()" />




<label for="green">
Verde
</label>
<input id="green" type="range" name="greenSlider" value="<?=($pieces)?$pieces[1]:'255'?>" min="0" max="255"  onchange = "changeBackground()" />

<label for="blue">
Azul
</label>
<input id="blue" type="range" name="blueSlider" value="<?=($pieces)?$pieces[2]:'255'?>" min="0" max="255"  onchange = "changeBackground()" />
<button id="commitColors" class="btn btn-primary" type="submit" name="commitColors" value="">Definir Color</button>
</form>
</div>
