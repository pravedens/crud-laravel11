<x-app-layout>
    <div class="w-full lg:ps-64">
        <div class="p-4 space-y-4 sm:p-6 sm:space-y-6">

            <h2 name="header" class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Categories
            </h2>


            <div class="text-gray-400">
                {{ Breadcrumbs::render('category') }}
            </div>

            <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Table Section -->
                <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-5 mx-auto">
                    <!-- Card -->
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div
                                    class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                                    <!-- Header -->
                                    <div
                                        class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                                        <div>
                                            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                                Categories
                                            </h2>
                                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                                Add categories, edit and more.
                                            </p>
                                        </div>

                                        <div>
                                            <div class="inline-flex gap-x-2">
                                                <form method="GET" action="{{ route('categories.index') }}">
                                                    <div class="max-w-sm space-y-3">
                                                        <input value="{{ request('search') }}" name="search"
                                                            type="text"
                                                            class="block w-full px-5 py-3 text-sm border-gray-200 rounded-full focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Input text">
                                                    </div>
                                                </form>

                                                <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                                    href={{ route('categories.create') }}>
                                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14" />
                                                        <path d="M12 5v14" />
                                                    </svg>
                                                    Add categories
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Header -->

                                    <!-- Table -->
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead class="bg-gray-50 dark:bg-neutral-800">
                                            <tr>
                                                <th scope="col" class="py-3 ps-6 text-start">
                                                    <span
                                                        class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">No</span>
                                                </th>
                                                <th scope="col" class="px-4 py-3 pe-6 text-start">
                                                    <div class="flex items-center gap-x-2">
                                                        <span
                                                            class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                            Name
                                                        </span>
                                                    </div>
                                                </th>

                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <div class="flex items-center gap-x-2">
                                                        <span
                                                            class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                            Slug
                                                        </span>
                                                    </div>
                                                </th>

                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <div class="flex items-center gap-x-2">
                                                        <span
                                                            class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                            Icon
                                                        </span>
                                                    </div>
                                                </th>

                                                <th scope="col" class="px-6 py-3 text-end"></th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @forelse ($categories as $index => $row)
                                                <tr>
                                                    <td class="size-px whitespace-nowrap">
                                                        <div class="py-3 ps-6">
                                                            <span
                                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">{{ $index + $categories->firstItem() }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="size-px whitespace-nowrap">
                                                        <div class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6">
                                                            <div class="flex items-center gap-x-3">
                                                                <div class="grow">
                                                                    <span
                                                                        class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $row->name }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="h-px w-72 whitespace-nowrap">
                                                        <div class="px-6 py-3">
                                                            <span
                                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $row->slug }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="h-px w-72 whitespace-nowrap">
                                                        <div class="px-6 py-3">
                                                            <img class="inline-block size-[38px] rounded-full"
                                                                src="{{ asset('storage/categories/' . $row->icon) }}"
                                                                alt="Image Icon">
                                                        </div>
                                                    </td>
                                                    <td class="size-px whitespace-nowrap">
                                                        <div class="px-6 py-1.5 flex gap-2">
                                                            <a href="{{ route('categories.edit', $row->slug) }}"
                                                                class="inline-flex items-center text-sm font-medium text-blue-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500"
                                                                href="#">
                                                                Edit
                                                            </a>
                                                            <form onsubmit="return confirm('Вы уверенны?')"
                                                                method="post"
                                                                action="{{ route('categories.destroy', $row->slug) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="inline-flex items-center text-sm font-medium text-red-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline dark:text-red-500"
                                                                    href="#">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <h1 class="mt-4 text-2xl text-center dark:text-gray-300">No Data
                                                </h1>
                                            @endforelse

                                        </tbody>
                                    </table>
                                    <!-- End Table -->

                                    <!-- Footer -->
                                    <div
                                        class="grid gap-3 px-6 py-4 border-t border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">

                                        {{ $categories->links('pagination::tailwind') }}
                                    </div>
                                    <!-- End Footer -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Table Section -->
            </div>
        </div>
    </div>
</x-app-layout>
