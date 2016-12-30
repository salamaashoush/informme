@extends('admin.layout')
@section('title','Map')
@section('styles')
    <style>
        html, body { height: 100%; margin: 0; padding: 0; }
        .wrapper,.content,.content-wrapper{ height: 100%;}
        .content {
            min-height: 0;
            padding: 0;
            margin-right: auto;
            margin-left: auto;
            padding-left: 0;
            padding-right: 0;
        }
        .content-header{display: none}
    </style>
@stop
@section('content')
    {!! Mapper::render() !!}
    <div class="modal fade" id="editdetails" tabindex="-1" role="dialog" aria-labelledby="Edit Center" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit  Info</h4>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')

@stop
