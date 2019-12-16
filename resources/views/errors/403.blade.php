@extends('layouts.app')

@section('content')
<v-container fill-height fluid class="justify-center bg-secondary bg-spinning-earth">
    <v-card dark class="transparent text-center" flat>
        <v-card-title class="display-2 font-weight-light my-10 justify-center">{{ __('Forbidden') }}</v-card-title>
        <v-card-text class="title font-weight-light my-10">403 Error :(</v-card-text>
        <v-card-text class="font-weight-light my-10">You are not allowed to access that page</v-card-text>
        <v-card-actions class="justify-center my-10">
            <v-btn large rounded outlined class="px-10" color="light" href="/">Back to home page</v-btn>
        </v-card-actions>
    </v-card>
</v-container>
@endsection