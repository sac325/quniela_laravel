@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('success');?>
                @endif
                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
                <div >
                <?php echo "<img style= 'height: 48px; margin-left: auto; margin-right: auto; display: block;' src=' " . asset("storage/upload/paypal.png") ."'> "; ?>
                </div>
                <div >
                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypal') !!}" >
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Licencias</label>
                            <div class="col-md-6">
                                <input id="amount" type="hidden" class="form-control" name="a" value="{{ old('amount') }}" autofocus>
                                <table>
                                <tr><td><br></td></tr><tr><td><select name="amount"  value="{{ old('amount') }}" >
	                                        <option value="5">10 Usuarios $5,00 USD</option>
	                                        <option value="10">30 Usuarios $10,00 USD</option>
	                                        <option value="20">Ilimitado $20,00 USD</option>
                                            </select> </td></tr>
                                </table>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            </div>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection