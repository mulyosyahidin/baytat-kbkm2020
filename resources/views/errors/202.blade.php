@extends('errors::minimal')

@section('title', $exception->getMessage())
@section('code', '204')
@section('message', $exception->getMessage())
