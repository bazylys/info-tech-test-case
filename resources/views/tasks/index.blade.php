<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="title">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tasks') }}
                </h2>
            </div>
            <div class="">
                <a href="{{ route('tasks.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    {{ __('Create new Task') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('status') === 'task-deleted')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Success!</span> {{ __('Task deleted.') }}.
                </div>
            @endif

            @if(session('status') === 'task-created')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Success!</span> {{ __('New task creted.') }}.
                </div>
            @endif
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deadline
                            </th>
                            <th scope="col" class="px-6 py-3" rowspan="2">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $task->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $task->description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $task->status->name() }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $task->deadline }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>Delete</x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</x-app-layout>
