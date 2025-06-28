<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.tailwindcss.com"></script>
    <title>Payment Success</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
  <div class="bg-white border border-gray-300 p-8 rounded-md w-full max-w-md h-fit">
        {{-- Tick icon --}}
                  <div class="absolute top-6 left-1/2 transform -translate-x-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor" class="size-20 text-green-600">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>

                  </div>

        {{-- Payment Amount --}}
        <p class="font-sans font-semibold text-xl text-center mt-10 mb-6">$97.00</p>

        {{-- confirmation message --}}
        <h1 class="text-center font-sans font-semibold text-2xl mb-2">Order was Confirmed!</h1>
        <p class="text-gray-800 text-center">Payment has been recieved successfully.</p>
        <p class="text-gray-800 text-center mt-2 mb-5 ">Thank you for your purchase. </p>


        {{-- Transaction details --}}
        <div class="border-y-2 border-gray-200 p-4">
                {{-- transaction code --}}
        <div class="flex justify-between mb-3 mt-3 font-semibold">
            <p class="text-gray-500">Transaction code</p>
            <p>00164853197</p>
        </div>

                {{-- name --}}
        <div class="flex justify-between mb-3 mt-3 font-semibold">
            <p class="text-gray-500">Name</p>
            <p class="">Archie Rai</p>
        </div>
        {{-- date --}}

        <div class="flex justify-between mb-3 mt-3 font-semibold">
            <p class="text-gray-500 ">Transaction Date</p>
            <p>17/06/2025</p>
        </div>
        </div>
        <form action="#" class="mt-5 text-center">
            <button style="background-color: #021526" class=" text-white w-full rounded-md p-2 font-sans">Download Invoice</button>
<div class="flex items-center justify-center">
                <button type="/homepage" class="text-gray-500 mt-2 font-semibold flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <p class="ml-2">Return to Homepage</p>
                </button>
            </div>        </form>
    </div>
</body>
</html>