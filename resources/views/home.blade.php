@extends('layouts.miniMed')

@section('content')
    <!-- =======================
                                                                 HERO SECTION WITH VIDEO BACKGROUND
                                                            ======================== -->
    <section class="relative min-h-screen flex items-center justify-center px-6 md:px-12 lg:px-24 overflow-hidden">
        <!-- Video Background -->
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-40 z-0">
            <source src="{{ asset('doctors/video/doctor-chat.mp4') }}" type="video/mp4">
            <!-- Replace with your healthcare video -->
        </video>
        <!-- Overlay for readability -->
        <div class="absolute inset-0 bg-gradient-to-b from-white/90 via-white/80 to-white/60 z-10"></div>
        <!-- Hero Content -->
        <div class="relative z-20 max-w-7xl mx-auto flex flex-col-reverse md:flex-row items-center justify-between gap-12">
            <div class="md:w-1/2 text-center md:text-left" data-aos="fade-right">
                <h1 class="text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                    Revolutionize Your Healthcare <br>
                    <span class="text-orange-500">Requuest Schedules</span> with Ease
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-lg">
                    MediProfessionals lets you connect with trusted doctors, track your health, and manage appointments —
                    all from
                    your device.
                </p>
                <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                    <a href="#features"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded shadow transition duration-300">
                        Explore Features
                    </a>
                    <a href="#telehealth"
                        class="border border-orange-500 text-orange-500 font-semibold px-8 py-3 rounded hover:bg-orange-50 transition duration-300">
                        Telehealth Consultations
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center" data-aos="fade-left">
                <img src="{{ asset('doctors/1.jpg') }}" alt="Doctor illustration"
                    class="w-full max-w-lg mx-auto rounded-lg shadow-lg border-4 border-white">
            </div>
        </div>
    </section>

    <!-- =======================
                                                                 TELEHEALTH HIGHLIGHT SECTION
                                                            ======================== -->
    <section id="telehealth" class="bg-orange-50 py-20 px-6 md:px-12 lg:px-24">
        <div class="max-w-6xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Virtual Care at Your Fingertips</h2>
            <p class="text-gray-700 mb-12 max-w-3xl mx-auto">
                Access certified doctors anytime, anywhere with our seamless telehealth video consultations. No waiting
                rooms, just quality care.
            </p>
            <a href="#"
                class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded shadow transition duration-300">
                Start a Telehealth Visit
            </a>
        </div>
    </section>

    <!-- =======================
                                                                 FEATURES SECTION
                                                            ======================== -->
    <section id="features" class="bg-gray-100 py-20 px-6 md:px-12 lg:px-24">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-12" data-aos="fade-up">Why Choose MediConnect?</h2>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="bg-white p-10 rounded-lg shadow-md hover:shadow-xl transition duration-300" data-aos="zoom-in">
                    <img src="{{ asset('doctors/10.jpg') }}" class="w-20 h-20 mx-auto mb-6" alt="Top-Rated Doctors Icon">
                    <h3 class="text-2xl font-semibold text-orange-500 mb-3">Top-Rated Doctors</h3>
                    <p class="text-gray-600 text-base leading-relaxed">All doctors on our platform are certified, rated by
                        patients, and reviewed for quality assurance.</p>
                </div>
                <div class="bg-white p-10 rounded-lg shadow-md hover:shadow-xl transition duration-300" data-aos="zoom-in"
                    data-aos-delay="100">
                    <img src="{{ asset('doctors/11.jpg') }}" class="w-20 h-20 mx-auto mb-6" alt="Smart Scheduling Icon">
                    <h3 class="text-2xl font-semibold text-orange-500 mb-3">Smart Scheduling</h3>
                    <p class="text-gray-600 text-base leading-relaxed">Set and manage appointments around your schedule with
                        real-time availability updates.</p>
                </div>
                <div class="bg-white p-10 rounded-lg shadow-md hover:shadow-xl transition duration-300" data-aos="zoom-in"
                    data-aos-delay="200">
                    <img src="{{ asset('doctors/12.jpg') }}" class="w-20 h-20 mx-auto mb-6"
                        alt="Secure Patient Portal Icon">
                    <h3 class="text-2xl font-semibold text-orange-500 mb-3">Secure Patient Portal</h3>
                    <p class="text-gray-600 text-base leading-relaxed">Access medical records, prescriptions, and doctor
                        notes securely in your private dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =======================
                                                                 CHAT WITH DOCTOR SECTION (WITH VIDEO)
                                                            ======================== -->
    <section id="chat-doctor" class="relative py-20 px-6 md:px-12 lg:px-24 bg-white overflow-hidden">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-12">
            <!-- Video Demo -->
            <div class="md:w-1/2" data-aos="fade-right">
                <div class="rounded-xl overflow-hidden shadow-lg border-4 border-orange-100">
                    <video autoplay loop muted poster="{{ asset('doctors/video/doctor-chat.mp4') }}"
                        class="w-full h-64 object-cover">
                        <source src="{{ asset('doctors/video/doctor-chat.mp4') }}" type="video/mp4">
                        <!-- Replace with your own video demo -->
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <!-- Chat Feature Info -->
            <div class="md:w-1/2 text-center md:text-left" data-aos="fade-left">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Chat Instantly with a Doctor</h2>
                <p class="text-gray-700 mb-6 max-w-md">
                    Need quick advice? Use our secure chat to connect with licensed doctors in real time. Share symptoms,
                    send images, and get professional guidance — all from your phone or computer.
                </p>
                <a href="#"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded shadow transition duration-300">
                    Start Chat Now
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Doctors Slider -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">👨‍⚕️ Meet Our Doctors</h2>
                <a href="{{ route('home.doctors') }}" class="text-orange-600 hover:underline text-sm font-semibold">View
                    All Doctors →</a>
            </div>

            <div class="overflow-x-auto">
                <div class="flex space-x-6 pb-4">
                    @foreach ($featuredDoctors as $doctor)
                        <div class="min-w-[200px] bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                            <img src="{{ $doctor->photo ? asset('storage/doctors/' . $doctor->photo) : asset('default-doctor.png') }}"
                                class="w-24 h-24 rounded-full mx-auto mb-3 object-cover border-4 border-orange-100"
                                alt="Doctor">
                            <h3 class="text-md font-semibold text-center text-gray-800">{{ $doctor->name }}</h3>
                            <p class="text-xs text-center text-gray-500">
                                {{ $doctor->specialization ?? 'General Practitioner' }}</p>
                            <div class="text-center mt-2">
                                <a href="{{ route('home.doctor.show', $doctor->id) }}"
                                    class="text-sm text-orange-600 hover:underline">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- =======================
                                                                 TESTIMONIALS SECTION
                                                            ======================== -->
    <section class="bg-gray-50 py-20 px-6 md:px-12 lg:px-24">
        <div class="max-w-5xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-10">What Our Users Say</h2>
            <p class="text-gray-600 max-w-3xl mx-auto mb-16">
                Our users love the simplicity and accessibility MediConnect provides. Whether you're a doctor or a patient —
                healthcare is now just a click away.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-10">
                <blockquote class="bg-white p-8 rounded-lg shadow-md text-left w-full md:w-1/2" data-aos="flip-left">
                    <p class="text-gray-700 mb-4 italic">"Finally a healthcare platform that works. Booking and rescheduling
                        appointments is so simple."</p>
                    <footer class="text-sm font-semibold text-orange-500">— Janet O., Client</footer>
                </blockquote>
                <blockquote class="bg-white p-8 rounded-lg shadow-md text-left w-full md:w-1/2" data-aos="flip-right">
                    <p class="text-gray-700 mb-4 italic">"As a doctor, MediConnect helps me manage patient appointments
                        without admin overhead."</p>
                    <footer class="text-sm font-semibold text-orange-500">— Dr. Yusuf A., Cardiologist</footer>
                </blockquote>
            </div>
            <a href="#"
                class="mt-12 inline-block bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded shadow transition duration-300">
                Join Now — It's Free
            </a>
        </div>
    </section>
@endsection
