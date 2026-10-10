@extends('layouts.app')

@section('title', 'About Us | Women\'s Health & Pelvic Floor Physiotherapy India – PelviCare')
@section('meta_description',
    'PelviCare is India\'s trusted platform for women\'s health physiotherapy. Connect with
    verified pelvic floor physiotherapists in Delhi NCR for pain during sex, incontinence, postpartum recovery & pregnancy
    care. Private, evidence-based care.')
@section('meta_keywords',
    'about PelviCare, women\'s health physiotherapy India, pelvic floor physiotherapy Delhi NCR,
    pelvic care, pain during sex treatment, postpartum physiotherapy, pregnancy pelvic pain, urinary incontinence women,
    women\'s health physiotherapist')

    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            .font-letter {
                font-family: 'Dancing Script', cursive;
            }

            .about-founder-bg {
                background: #fdf2f8;
            }

            .about-section-label {
                font-size: 0.6875rem;
                font-weight: 600;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: #9ca3af;
            }

            /* Consistent content width and spacing */
            .about-section {
                padding: 3rem 1rem;
            }

            @media (min-width: 640px) {
                .about-section {
                    padding: 3.5rem 1.5rem;
                }
            }

            @media (min-width: 1024px) {
                .about-section {
                    padding: 4rem 2rem;
                }
            }

            .about-content {
                max-width: 72rem;
                margin-left: auto;
                margin-right: auto;
            }

            .about-text-width {
                max-width: 42rem;
            }

            .about-intro-width {
                max-width: 48rem;
            }
        </style>
    @endpush

@section('content')

    {{-- ========== About Us (SEO intro) ========== --}}
    <section class="about-section bg-gradient-to-br from-pink-50/80 via-white to-pink-50/60 border-b border-pink-100/50">
        <div class="about-content px-2 sm:px-4 lg:pl-4 lg:pr-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12 items-stretch">
                <div class="lg:col-span-3 flex flex-col justify-center">
                    <p class="about-section-label mb-2">About us</p>
                    <h1 class="text-2xl sm:text-3xl font-bold heading-font text-gray-900 tracking-tight mb-5">
                        About PelviCare
                    </h1>
            <p class="text-gray-700 text-base leading-relaxed mb-4">
                PelviCare is India’s dedicated platform for women’s health physiotherapy and pelvic floor care. We connect
                women with verified, experienced pelvic floor physiotherapists across Delhi NCR and beyond—for conditions
                that are common, treatable, and too often misunderstood.
            </p>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">
                Whether you’re dealing with pain during sex, urinary incontinence, postpartum recovery, pregnancy-related
                pelvic pain, or the feeling that “something isn’t right”—our network offers evidence-based, private, and
                judgment-free care tailored to you.
            </p>
            <p class="text-gray-500 text-sm mt-6">
                We believe women’s pain is real, and it deserves to be heard.
            </p>
                </div>
                <div class="lg:col-span-2 flex items-center justify-center lg:justify-end">
                    <img src="{{ asset('images/pelvicarehealth_logo.png') }}" alt="PelviCare – Women's Health Physiotherapy" class="h-24 sm:h-28 lg:h-32 w-auto object-contain">
                </div>
            </div>
        </div>
    </section>

    {{-- ========== Our Mission ========== --}}
    <section class="about-section bg-pink-50/40 border-b border-pink-100/50">
        <div class="about-content px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12 items-stretch">
                <div class="lg:col-span-3 flex flex-col justify-center">
                    <div class="space-y-4 text-gray-700 text-sm sm:text-base leading-relaxed">
                        <h2 class="text-xl sm:text-2xl font-bold heading-font text-gray-900 tracking-tight mb-3">
                            Our Mission
                        </h2>
                        <p class="text-gray-600 text-sm sm:text-base max-w-2xl mx-auto mb-10">At PelviCare, our
                            mission
                            begins with a simple belief: <strong class="text-gray-800">women's pain is real</strong>, and it
                            deserves to
                            be heard.</p>
                        <p>For decades, women have been told that urine leakage is "normal," pain during intimacy is "in the
                            mind," or that they must simply "adjust" after childbirth or menopause. Too many women live
                            silently with discomfort, shame, or unanswered questions.</p>
                        <p class="font-semibold text-gray-900">PelviCare exists to change that.</p>
                        <ul class="space-y-2 list-none pl-0">
                            <li class="flex items-start gap-2"><span
                                    class="shrink-0 w-1.5 h-1.5 rounded-full bg-pink-500 mt-1.5"></span><span>We listen to
                                    what women are experiencing</span></li>
                            <li class="flex items-start gap-2"><span
                                    class="shrink-0 w-1.5 h-1.5 rounded-full bg-pink-500 mt-1.5"></span><span>Every concern
                                    is taken seriously</span></li>
                            <li class="flex items-start gap-2"><span
                                    class="shrink-0 w-1.5 h-1.5 rounded-full bg-pink-500 mt-1.5"></span><span>Every care
                                    plan is personalised, not rushed</span></li>
                        </ul>
                        <p>Whether it is pelvic pain, bladder or bowel issues, sexual health concerns, pregnancy-related
                            discomfort, postpartum recovery, or menopause changes, PelviCare ensures that women are guided
                            with respect, evidence-based care, and compassion – never judgment.</p>
                        <p class="text-center text-gray-500 text-sm mt-10 max-w-xl mx-auto italic">Because women deserve
                            care that
                            listens, understands, and truly helps.</p>
                    </div>
                </div>
                <div class="lg:col-span-2 flex min-h-0">
                    <div
                        class="w-full max-w-sm mx-auto lg:mx-0 lg:w-full h-full flex flex-col theme-card-solid rounded-xl border border-pink-100 overflow-hidden">
                        <div class="relative w-full aspect-[3/4] sm:aspect-[4/5] shrink-0 bg-gray-100">
                            <img src="{{ asset('images/dr-sunita.png') }}" alt="Dr. Sunita Patel"
                                class="w-full h-full object-cover object-top">
                        </div>
                        <div class="flex flex-col justify-center p-5 sm:p-6 flex-1">
                            <h3 class="font-semibold text-gray-900 text-base sm:text-lg">Dr. Sunita Patel</h3>
                            <p class="text-gray-600 text-sm mt-1">Women's Health & Pelvic Floor Physiotherapist</p>
                            <p class="text-gray-500 text-sm mt-2">19+ years clinical experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== Our Core Values ========== --}}
    <section class="about-section bg-white border-b border-pink-100/50">
        <div class="about-content px-4 sm:px-6 lg:px-8">
            <p class="about-section-label text-center mb-2">What we stand for</p>
            <h2 class="text-center text-xl sm:text-2xl font-bold heading-font text-gray-900 tracking-tight mb-3">Our Core
                Values</h2>
            <p class="text-center text-gray-600 text-sm sm:text-base max-w-2xl mx-auto mb-10">Evidence-based pelvic health
                physiotherapy that is <strong class="text-gray-800">accessible</strong>, respectful, and personalised for
                every woman.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Compassion</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">A safe, nonjudgmental environment where you can discuss
                        sensitive pelvic health issues. Your feelings and experiences are honoured.</p>
                </div>
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-pink-600 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Excellence</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">We stay updated with the latest research and techniques
                        in pelvic health physiotherapy, ensuring effective, evidence-based care.</p>
                </div>
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-pink-600 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Empowerment</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">We empower women with knowledge, tools, and confidence
                        to participate in their healing and maintain their health.</p>
                </div>
            </div>
            <p class="text-center text-gray-500 text-sm mt-10 max-w-xl mx-auto">Led by clinical expertise and compassion, we
                bridge the gap between women's concerns and the care they deserve.</p>
        </div>
    </section>

    {{-- ========== How We Help You Heal ========== --}}
    <section class="about-section bg-pink-50/40 border-b border-pink-100/50">
        <div class="about-content px-4 sm:px-6 lg:px-8">
            <p class="about-section-label text-center mb-2">Our approach</p>
            <h2 class="text-center text-xl sm:text-2xl font-bold heading-font text-gray-900 tracking-tight mb-3">How We Help
                You Heal</h2>
            <p class="text-center text-gray-600 text-sm sm:text-base max-w-2xl mx-auto mb-10">Evidence-based women's health
                physiotherapy, personalised to your body, symptoms, and life stage.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-4">
                {{-- 1. Manual Therapy --}}
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 pt-0.5">Manual Therapy</h3>
                    </div>
                    <p class="text-gray-600 text-xs leading-relaxed mb-3">Hands-on techniques to relieve pelvic, back, and
                        intimate pain by addressing muscle tension, scar restrictions, and joint stiffness.</p>
                    <ul class="space-y-1.5 text-gray-600 text-xs mb-2 list-none pl-0">
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Soft tissue mobilisation</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Myofascial release</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Joint mobilisation</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Scar tissue mobilisation</li>
                    </ul>
                    <p class="text-gray-500 text-xs mt-2 mb-0">Commonly used for pelvic pain, painful intercourse,
                        post-surgery recovery, back pain, and postpartum discomfort.</p>
                </div>

                {{-- 2. Pelvic Floor Exercises --}}
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 pt-0.5">Pelvic Floor Exercises</h3>
                    </div>
                    <p class="text-gray-600 text-xs leading-relaxed mb-3">Personalised exercises to strengthen, relax, or
                        coordinate pelvic floor muscles — based on your individual assessment.</p>
                    <ul class="space-y-1.5 text-gray-600 text-xs mb-2 list-none pl-0">
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Kegel exercises (only when
                            appropriate)</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Pelvic floor relaxation &
                            down-training</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Biofeedback-guided exercises
                        </li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Progressive muscle
                            strengthening</li>
                    </ul>
                    <p class="text-gray-500 text-xs mt-2 mb-0">Not all pelvic issues need strengthening — assessment always
                        comes first.</p>
                </div>

                {{-- 3. Biofeedback Therapy --}}
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 pt-0.5">Biofeedback Therapy</h3>
                    </div>
                    <p class="text-gray-600 text-xs leading-relaxed mb-3">Technology-assisted training to help you
                        understand and improve pelvic floor muscle control using real-time visual or auditory feedback.</p>
                    <ul class="space-y-1.5 text-gray-600 text-xs mb-2 list-none pl-0">
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Real-time muscle activity
                            monitoring</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Visual feedback systems</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Muscle coordination & control
                            training</li>
                    </ul>
                    <p class="text-gray-500 text-xs mt-2 mb-0">Helpful for urinary or bowel issues, pelvic floor
                        dysfunction, and difficulty sensing muscles.</p>
                </div>

                {{-- 4. Education & Lifestyle Guidance --}}
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 pt-0.5">Education & Lifestyle Guidance</h3>
                    </div>
                    <p class="text-gray-600 text-xs leading-relaxed mb-3">Empowering you with knowledge about your body so
                        you can manage symptoms confidently in daily life.</p>
                    <ul class="space-y-1.5 text-gray-600 text-xs mb-2 list-none pl-0">
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Bladder training</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Bowel management strategies
                        </li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Posture & ergonomic advice
                        </li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Daily activity and habit
                            modifications</li>
                    </ul>
                    <p class="text-gray-500 text-xs mt-2 mb-0">Education is a key part of long-term recovery and
                        prevention.</p>
                </div>

                {{-- 5. Core Strengthening & Stability --}}
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 pt-0.5">Core Strengthening & Stability</h3>
                    </div>
                    <p class="text-gray-600 text-xs leading-relaxed mb-3">Strengthening deep core muscles that support the
                        pelvis and spine — essential during pregnancy, postpartum, and chronic pain recovery.</p>
                    <ul class="space-y-1.5 text-gray-600 text-xs mb-2 list-none pl-0">
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Deep core muscle activation
                        </li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Postural retraining</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Functional movement patterns
                        </li>
                    </ul>
                    <p class="text-gray-500 text-xs mt-2 mb-0">Commonly used for diastasis recti, back pain, pelvic
                        instability, and postnatal recovery.</p>
                </div>

                {{-- 6. Pain Management --}}
                <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 pt-0.5">Pain Management</h3>
                    </div>
                    <p class="text-gray-600 text-xs leading-relaxed mb-3">Gentle, evidence-based approaches to reduce
                        chronic pelvic, back, and intimate pain.</p>
                    <ul class="space-y-1.5 text-gray-600 text-xs list-none pl-0">
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Relaxation techniques</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Breathing exercises</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Pain neuroscience education
                        </li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Nervous system calming
                            strategies</li>
                    </ul>
                    <p class="text-gray-500 text-xs mt-2 mb-0">Especially helpful for chronic pelvic pain,
                        endometriosis-related pain, and sexual pain.</p>
                </div>

                {{-- 7. Scar & Perineal Rehabilitation --}}
                <!-- <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 pt-0.5">Scar & Perineal Rehabilitation</h3>
                    </div>
                    <p class="text-gray-600 text-xs leading-relaxed mb-3">Specialised care for scars and perineal tissues
                        after childbirth or surgery — an often overlooked but crucial part of recovery.</p>
                    <ul class="space-y-1.5 text-gray-600 text-xs list-none pl-0">
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> C-section scar therapy</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Episiotomy & perineal scar
                            care</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Scar desensitisation</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Tissue mobility restoration
                        </li>
                    </ul>
                    <p class="text-gray-500 text-xs mt-2 mb-0">Supports pain-free movement, pelvic health, and
                        comfortable intimacy.</p>
                </div> -->

                {{-- 8. Pregnancy & Antenatal Physiotherapy --}}
                <!-- <div
                    class="theme-card-solid rounded-xl p-4 sm:p-5 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 pt-0.5">Pregnancy & Antenatal Physiotherapy</h3>
                    </div>
                    <p class="text-gray-600 text-xs leading-relaxed mb-3">Safe, evidence-based <strong>antenatal
                            care</strong> and <strong>pregnancy physiotherapy</strong> to manage pelvic girdle pain, back
                        pain, and prepare your body for labour and postpartum recovery.</p>
                    <ul class="space-y-1.5 text-gray-600 text-xs mb-2 list-none pl-0">
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Pelvic girdle pain (PGP)
                            management</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Prenatal exercise & posture
                        </li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Labour preparation & perineal
                            care</li>
                        <li class="flex items-center gap-2"><span
                                class="w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0"></span> Breathing techniques for
                            pregnancy</li>
                    </ul>
                    <p class="text-gray-500 text-xs mt-2 mb-0">Ideal for pregnancy-related discomfort, staying active
                        safely, and reducing risk of postpartum issues.</p>
                </div> -->
            </div>
        </div>
    </section>

    {{-- ========== Why Choose Pelvicare? ========== --}}
    <section class="about-section bg-white border-b border-pink-100/50">
        <div class="about-content px-4 sm:px-6 lg:px-8">
            <p class="about-section-label text-center mb-2">Why us</p>
            <h2 class="text-center text-xl sm:text-2xl font-bold heading-font text-gray-900 tracking-tight mb-3">Why Choose
                PelviCare?</h2>
            <p class="text-center text-gray-600 text-sm sm:text-base max-w-2xl mx-auto mb-10">Verified specialists,
                evidence-based care, and a commitment to your comfort and privacy.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                <div class="theme-card-solid rounded-xl p-5 sm:p-6 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-pink-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Specialised Expertise</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Focused training in women's pelvic health
                        physiotherapy.</p>
                </div>
                
                <div class="theme-card-solid rounded-xl p-5 sm:p-6 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-pink-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Evidence-Based</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Treatment grounded in the latest research and
                        clinical evidence.</p>
                </div>

                <div class="theme-card-solid rounded-xl p-5 sm:p-6 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-pink-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Personalized Care</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Each plan customized to your needs, goals, and
                        lifestyle.</p>
                </div>

                <div class="theme-card-solid rounded-xl p-5 sm:p-6 border border-pink-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-pink-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Comprehensive Support</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">From assessment through treatment and
                        follow-up, we're with you every step.</p>
                </div>
            </div>
            <p class="text-center text-gray-500 text-sm mt-10 max-w-xl mx-auto">We combine expertise with empathy so you
                receive care that respects your story and your goals.</p>
        </div>
    </section>

    {{-- ========== A Letter from the Founder ========== --}}
    <section class="about-section bg-pink-50/30">
        <div class="about-content px-4 sm:px-6 lg:px-8">
            <div class="theme-card rounded-2xl border border-pink-100 overflow-hidden max-w-6xl mx-auto">
                <p class="about-section-label text-center mb-2 pt-10">From our founder</p>
                <h2 class="text-center font-letter font-semibold text-gray-800 pb-2 text-2xl sm:text-3xl">A Letter from the
                    Founder</h2>
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12 px-6 sm:px-8 lg:px-10 py-8 pb-10 sm:pb-12">
                    <div class="lg:col-span-3 space-y-4 text-gray-700 text-sm sm:text-base leading-relaxed">
                        <p class="font-semibold text-gray-900">Dear women,</p>
                        <p>Over 19+ years in women's health physiotherapy, countless women have sat across from me—eyes
                            brimming with tears, voices lowered, hearts full of questions they felt too vulnerable to ask.
                        </p>
                        <p class="italic text-gray-600 space-y-1 block">
                            <span class="block">"No one believes me."</span>
                            <span class="block">"I thought this was just part of being a woman."</span>
                            <span class="block">"I was told to just adjust."</span>
                            <span class="block">"Am I the only one?"</span>
                        </p>
                        <p>No woman should have to live in pain, discomfort, shame, or confusion. I founded PelviCare so
                            women have a place where their pain is taken seriously and treated with care.</p>
                        <p>You are not alone. Your concerns are real, and healing is possible. I hope you find PelviCare to
                            be a space of compassion, where your voice matters and care is tailored to your journey—with
                            respect, expertise, and kindness.</p>
                        <p class="text-right font-letter text-xl sm:text-2xl font-semibold text-gray-800 pt-2">— Dr. Sunita
                            Patel</p>
                    </div>
                    <div class="lg:col-span-2 flex flex-col items-center lg:items-end justify-center gap-6">
                        <div
                            class="w-full max-w-[240px] rounded-xl overflow-hidden bg-gray-100 shadow-sm shrink-0 border border-pink-100/50">
                            <img src="{{ asset('images/dr-sunita.png') }}" alt="Dr. Sunita Patel, Founder"
                                class="w-full h-auto object-cover aspect-[3/4] object-top">
                        </div>
                        <div
                            class="w-full max-w-[240px] about-founder-bg rounded-xl p-5 shrink-0 border border-pink-100/50">
                            <h3 class="font-bold text-gray-900 text-lg">Dr. Sunita Patel</h3>
                            <p class="text-gray-600 text-sm mt-1">Women's Health & Pelvic Floor Physiotherapist</p>
                            <p class="text-gray-600 text-sm font-medium mt-2">Founder of PelviCare</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== CTA ========== --}}
    <section class="about-section bg-gradient-to-br from-gray-900 to-gray-800">
        <div class="about-content px-4 sm:px-6 lg:px-8 text-center max-w-2xl mx-auto">
            <h2 class="text-xl sm:text-2xl font-bold heading-font text-white tracking-tight mb-2">Ready to start your
                journey?</h2>
            <p class="text-gray-300 text-sm mb-6">Schedule a consultation and learn how we can help you.</p>
            <a href="{{ route('contact') }}"
                class="inline-flex items-center justify-center px-6 py-3 rounded-xl font-semibold text-white bg-pink-600 hover:bg-pink-700 transition-colors text-sm shadow-lg hover:shadow-xl">
                Get in touch
            </a>
        </div>
    </section>
@endsection
