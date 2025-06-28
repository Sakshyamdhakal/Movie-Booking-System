<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Payment Success</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4 relative">
    <div class="bg-white border border-gray-300 p-8 rounded-md w-fit max-w-lg h-fit relative">
        {{-- Tick icon --}}
        <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
            <svg class="text-red-600 w-20 h-20" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>

        {{-- failed message --}}
        <div class="mb-4 font-sans mt-12">
            <h1 class="text-center text-red-600 font-sans font-bold text-2xl mb-2">Payment Failed</h1>
            <p style="color: #021526" class=" text-center mt-6">Unfortunately, your payment could not be processed.</p>
            <p style="color: #021526" class="text-gray-800 text-center">Please try again or use a different method.</p>
        </div>

        <form action="#" class="mt-5 text-center">
            <button style="background-color: #021526" class=" text-white w-full rounded-md p-2 font-sans">Try Again</button>
            <div class="flex items-center justify-center">
                <button type="/homepage" class="text-gray-500 mt-2 font-semibold flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <p class="ml-2">Return to Homepage</p>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
