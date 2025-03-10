@props(['site'])

<!-- Footer -->
<footer class="bg-secondary-500 text-gray-300">
    <!-- Newsletter Section -->
    <div class="border-b border-gray-800 relative">
        <div class="mx-auto px-4 py-12" style="background-image: url('{{ asset('img/spotlights.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="max-w-3xl mx-auto text-center">
                <h3 class="text-2xl font-semibold mb-0">{{ __('footer.newsletter.title') }}</h3>
                <h3 class="text-3xl text-primary-500 font-semibold mb-6">{{ __('footer.newsletter.brand') }}</h3>
                <form class="flex flex-col gap-4 justify-center items-center">
                    <div class="flex flex-col sm:flex-row gap-4 w-full justify-center items-center">
                        <input type="text" placeholder="{{ __('footer.newsletter.name') }}" required class="w-full sm:w-auto px-4 py-2 bg-neutral-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <input type="email" placeholder="{{ __('footer.newsletter.email') }}" required class="w-full sm:w-auto px-4 py-2 bg-neutral-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <select required class="w-full sm:w-auto pe-12 py-2 bg-neutral-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">{{ __('footer.newsletter.province') }}</option>
                            @foreach(__('footer.provinces') as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-start gap-2 text-sm text-gray-400 max-w-2xl">
                        <input type="checkbox" required id="privacy-accept" class="mt-1 rounded border-gray-700 bg-neutral-800 text-orange-500 focus:ring-orange-500">
                        <label for="privacy-accept" class="cursor-pointer">
                            {{ __('footer.newsletter.privacy.text') }}
                            <a href="#" class="text-orange-500 hover:underline">{{ __('footer.newsletter.privacy.more_info') }}</a>
                        </label>
                    </div>
                    <button type="submit" class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors duration-300">{{ __('footer.newsletter.submit') }}</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Footer Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <img src="{{ asset('resources/logo-entertainment.svg') }}" alt="beon. Entertainment" class="h-10 mb-4 filter brightness-0 invert">
                <div class="space-y-4">
                    <p class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ __('footer.company.phone') }}
                    </p>
                    <div class="text-sm">
                        <p>{{ __('footer.company.schedule.weekdays') }}</p>
                        <p class="text-orange-500">{{ __('footer.company.schedule.weekdays_hours') }}</p>
                        <p>{{ __('footer.company.schedule.friday') }}</p>
                        <p class="text-orange-500">{{ __('footer.company.schedule.friday_hours') }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Links 1 -->
            <div>
                <h4 class="text-lg font-semibold mb-4">{{ __('footer.links.company.title') }}</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-orange-500 transition-colors duration-300">{{ __('footer.links.company.producer') }}</a></li>
                    <li><a href="#" class="hover:text-orange-500 transition-colors duration-300">{{ __('footer.links.company.work') }}</a></li>
                    <li><a href="#" class="hover:text-orange-500 transition-colors duration-300">{{ __('footer.links.company.faq') }}</a></li>
                    <li><a href="#" class="hover:text-orange-500 transition-colors duration-300">{{ __('footer.links.company.ethics') }}</a></li>
                </ul>
            </div>

            <!-- Quick Links 2 -->
            <div>
                <h4 class="text-lg font-semibold mb-4">{{ __('footer.links.legal.title') }}</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-orange-500 transition-colors duration-300">{{ __('footer.links.legal.contact') }}</a></li>
                    <li><a href="#" class="hover:text-orange-500 transition-colors duration-300">{{ __('footer.links.legal.notice') }}</a></li>
                    <li><a href="#" class="hover:text-orange-500 transition-colors duration-300">{{ __('footer.links.legal.cookies') }}</a></li>
                    <li><a href="#" class="hover:text-orange-500 transition-colors duration-300">{{ __('footer.links.legal.privacy') }}</a></li>
                </ul>
            </div>

            <!-- Social Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">{{ __('footer.links.social.title') }}</h4>
                <div class="flex space-x-4">
                    <a href="https://www.instagram.com/beon.entertainment/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-orange-500 transition-colors duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="https://es.linkedin.com/showcase/beonentertainmentww/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-orange-500 transition-colors duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            <div class="text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} {{ $site->getName() }}. {{ __('content.all_rights_reserved') }}.
            </div>
        </div>
    </div>
</footer>
