@extends('layouts.admin')

@section('content')

    <!-- ========== MAIN CONTENT ========== -->
    <!-- Breadcrumb -->
    <div class="sticky top-0 inset-x-0 z-20 bg-navbar border-y border-navbar-line px-4 sm:px-6 lg:px-8 lg:hidden">
        <div class="flex items-center py-2">
            <!-- Navigation Toggle -->
            <button type="button"
                class="size-8 flex justify-center items-center gap-x-2 bg-layer border border-layer-line text-layer-foreground hover:text-layer-foreground-hover rounded-lg focus:outline-hidden focus:text-layer-foreground-focus disabled:opacity-50 disabled:pointer-events-none"
                aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-application-sidebar"
                aria-label="Toggle navigation" data-hs-overlay="#hs-application-sidebar">
                <span class="sr-only">Toggle Navigation</span>
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M15 3v18" />
                    <path d="m8 9 3 3-3 3" />
                </svg>
            </button>
            <!-- End Navigation Toggle -->

            <!-- Breadcrumb -->
            <ol class="ms-3 flex items-center whitespace-nowrap">
                <li class="flex items-center text-sm text-foreground">
                    Application Layout
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-muted-foreground" width="16"
                        height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </li>
                <li class="text-sm font-semibold text-foreground truncate" aria-current="page">
                    Dashboard
                </li>
            </ol>
            <!-- End Breadcrumb -->
        </div>
    </div>
    <!-- End Breadcrumb -->


    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <!-- Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card -->
                <div class="flex flex-col bg-card border border-card-line shadow-2xs rounded-xl">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-xs uppercase text-muted-foreground-1">
                                Total users
                            </p>
                            <div class="hs-tooltip">
                                <div class="hs-tooltip-toggle">
                                    <svg class="shrink-0 size-4 text-muted-foreground-1"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                        <path d="M12 17h.01" />
                                    </svg>
                                    <span
                                        class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-tooltip border border-tooltip-line text-xs font-medium text-tooltip-foreground rounded-md shadow-2xs"
                                        role="tooltip">
                                        The number of daily users
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-foreground">
                                72,540
                            </h3>
                            <span class="flex items-center gap-x-1 text-green-600">
                                <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" />
                                    <polyline points="16 7 22 7 22 13" />
                                </svg>
                                <span class="inline-block text-sm">
                                    1.7%
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col bg-card border border-card-line shadow-2xs rounded-xl">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-xs uppercase text-muted-foreground-1">
                                Sessions
                            </p>
                        </div>

                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-foreground">
                                29.4%
                            </h3>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col bg-card border border-card-line shadow-2xs rounded-xl">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-xs uppercase text-muted-foreground-1">
                                Avg. Click Rate
                            </p>
                        </div>

                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-foreground">
                                56.8%
                            </h3>
                            <span class="flex items-center gap-x-1 text-red-600">
                                <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="22 17 13.5 8.5 8.5 13.5 2 7" />
                                    <polyline points="16 17 22 17 22 11" />
                                </svg>
                                <span class="inline-block text-sm">
                                    1.7%
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col bg-card border border-card-line shadow-2xs rounded-xl">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-xs uppercase text-muted-foreground-1">
                                Pageviews
                            </p>
                        </div>

                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-foreground">
                                92,913
                            </h3>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Grid -->

            <div class="grid lg:grid-cols-2 gap-4 sm:gap-6">
                <!-- Card -->
                <div class="p-4 md:p-5 min-h-102.5 flex flex-col bg-card border border-card-line shadow-2xs rounded-xl">
                    <!-- Header -->
                    <div class="flex flex-wrap justify-between items-center gap-2">
                        <div>
                            <h2 class="text-sm text-muted-foreground-1">
                                Income
                            </h2>
                            <p class="text-xl sm:text-2xl font-medium text-foreground">
                                $126,238.49
                            </p>
                        </div>

                        <div>
                            <span
                                class="py-[5px] px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-md bg-teal-100 text-teal-800">
                                <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                                25%
                            </span>
                        </div>
                    </div>
                    <!-- End Header -->

                    <div id="hs-multiple-bar-charts"></div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="p-4 md:p-5 min-h-102.5 flex flex-col bg-card border border-card-line shadow-2xs rounded-xl">
                    <!-- Header -->
                    <div class="flex flex-wrap justify-between items-center gap-2">
                        <div>
                            <h2 class="text-sm text-muted-foreground-1">
                                Visitors
                            </h2>
                            <p class="text-xl sm:text-2xl font-medium text-foreground">
                                80.3k
                            </p>
                        </div>

                        <div>
                            <span
                                class="py-[5px] px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-md bg-red-100 text-red-800">
                                <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                                2%
                            </span>
                        </div>
                    </div>
                    <!-- End Header -->

                    <div id="hs-single-area-chart"></div>
                </div>
                <!-- End Card -->
            </div>

            
        </div>
    </div>
    <!-- End Content -->

   
    </body>

    </html>

    </div>
@endsection
