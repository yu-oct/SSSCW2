
<x-guest-layout>    
<div class="flex items-center justify-center h-screen">
<div class="text-2xl">
  Welcome to Yu's webapp
</div>
</div>
<div class="flex items-center">
<img src="images/icons8-folder.gif"  class="mr-2 h-6 w-6">
<h1>This is an ONLINE FOLDER. Here you can store your notes and files and of course you can view, modify and delete them. In this community, we will also provide forums for discussion and feedback.</h1>
</div>
<div class="flex items-center">
    <img src="images/icons8-login.gif"  class="mr-2 h-6 w-6">
    <a href="{{ route('login') }}" class="font-semibold text-lg text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Log In Now</a>
</div>
    <div class="flex items-center">
    <img src="images/icons8-join-64.png" class="mr-2 h-12 w-12">
    <a href="{{ route('register') }}" class="font-semibold text-lg text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">I don't have an account. Register Now</a>
</div>
</x-guest-layout>

