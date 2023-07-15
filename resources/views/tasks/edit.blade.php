<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task #') . $task->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Task information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Provide some task information.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('tasks.update', $task->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $task->title)" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-textarea id="description" name="description" class="mt-1 w-full" :value="old('description', $task->title)" autocomplete="description" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <x-input-label for="deadline" :value="__('Deadline')" />
                                <x-datetime-input id="deadline" name="deadline" class="mt-1 w-full" :value="old('deadline', $task->deadline)" required autocomplete="deadline" />
                                <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <x-select-input id="status" name="status" class="mt-1 w-full" required autocomplete="status">
                                    @foreach($taskStatuses as $taskStatus)
                                        <option value="{{ $taskStatus->value }}" @selected($taskStatus->value == old('status', $task->status->value))>{{ $taskStatus->name() }}</option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>

                                @if (session('status') === 'task-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Updated.') }}</p>
                                @endif

                                @if(session('status') === 'task-update-error')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-indigo-600"
                                    >{{ __('Some error.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Delete Task') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Once your task is deleted, all of its resources and data will be permanently deleted. Before deleting your task, please download any data or information that you wish to retain.") }}
                            </p>
                        </header>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>Delete</x-danger-button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
