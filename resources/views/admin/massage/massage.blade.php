<x-admin-layout title="Class">


    <div class="row justify-content-center">
        <div class="container">


            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Contact Form</title>
            </head>

            <body>
                @foreach ($massage as $massage)
                

                <h1>Contact Message</h1>
                <p>Name: {{ $massage->user->name }} </p>
                <p>Email: {{ $massage->user->email }} </p>
                <p>Subject: {{ $massage->name }} </p>
                <p>Message: {{ $massage->subject }} </p>
                @endforeach
            </body>

            </html>

        </div>

    </div>



</x-admin-layout>