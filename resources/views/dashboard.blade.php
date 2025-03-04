<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('Edit Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto px-4 py-10">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-center">Task List</h2>

            <!-- Task Card List -->
            <div class="grid gap-4">
                
                <!-- Task 1 -->
                <div class="bg-white p-5 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Complete Laravel Project</h3>
                        <span class="px-3 py-1 text-sm font-semibold text-white rounded bg-green-500">
                            Completed
                        </span>
                    </div>
                    <p class="text-gray-600 mt-2">Finish the Laravel project and deploy it.</p>
                    <div class="mt-4 flex justify-end space-x-4">
                        <a href="#" class="text-blue-500 hover:underline">Edit</a>
                        <a href="#" class="text-red-500 hover:underline">Delete</a>
                    </div>
                </div>

                <!-- Task 2 -->
                <div class="bg-white p-5 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Fix Login Issues</h3>
                        <span class="px-3 py-1 text-sm font-semibold text-white rounded bg-red-500">
                            Pending
                        </span>
                    </div>
                    <p class="text-gray-600 mt-2">Investigate and fix user login issues.</p>
                    <div class="mt-4 flex justify-end space-x-4">
                        <a href="#" class="text-blue-500 hover:underline">Edit</a>
                        <a href="#" class="text-red-500 hover:underline">Delete</a>
                    </div>
                </div>

                <!-- Task 3 -->
                <div class="bg-white p-5 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Update UI Design</h3>
                        <span class="px-3 py-1 text-sm font-semibold text-white rounded bg-yellow-500">
                            In Progress
                        </span>
                    </div>
                    <p class="text-gray-600 mt-2">Redesign the dashboard and improve UX.</p>
                    <div class="mt-4 flex justify-end space-x-4">
                        <a href="#" class="text-blue-500 hover:underline">Edit</a>
                        <a href="#" class="text-red-500 hover:underline">Delete</a>
                    </div>
                </div>

            </div>

            <!-- Add New Task Button -->
            <div class="mt-6 text-center">
                <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                    Add New Task
                </a>
            </div>

        </div>
    </div>
</body>
</html>
