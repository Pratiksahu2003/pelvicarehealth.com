@extends('layouts.app')

@section('title', 'Frequently Asked Questions | Women\'s Health & Pelvic Floor Physiotherapy – Pelvicare')
@section('meta_description', 'Answers to common questions about pelvic floor physiotherapy, pain during sex, incontinence, pregnancy & postpartum care. Expert women\'s health physiotherapy FAQs – Pelvicare India.')
@section('meta_keywords', 'pelvic floor physiotherapy FAQ, pain during sex FAQ, urinary incontinence women, postpartum physiotherapy, women\'s health physiotherapy India, pelvic pain questions, vaginismus, pregnancy pelvic pain')

@push('meta')
    <link rel="canonical" href="{{ url()->current() }}">
@endpush

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-900 mb-4">
                Frequently Asked Questions
            </h1>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                Honest answers about pelvic floor health, women's physiotherapy, and what to expect—so you can make informed decisions with confidence.
            </p>
        </div>
    </section>

    <!-- Intro -->
    <section class="py-8 bg-white border-b border-gray-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-gray-700 text-lg leading-relaxed text-center">
                Many of the concerns we hear—pain during intimacy, leaking when you laugh, fear after childbirth, or pelvic pain with "normal" test results—are more common than you think and often treatable. Below we've answered the questions we hear most often, in plain language. If you don't see yours here, we're only a message away.
            </p>
        </div>
    </section>

    <!-- FAQ Accordion (two columns on large screens) -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-start" itemscope itemtype="https://schema.org/FAQPage">
                @php
                    $faqs = [
                        // General / What we do
                        [
                            'q' => 'What is pelvic floor physiotherapy (women\'s health physiotherapy)?',
                            'a' => 'Pelvic floor physiotherapy is a specialized branch of physiotherapy that focuses on the muscles, ligaments, and connective tissues that support your bladder, bowel, and reproductive organs. A women\'s health physiotherapist is trained to assess and treat conditions like pelvic pain, urinary or faecal incontinence, pain during sex, pregnancy-related discomfort, and postpartum recovery—using hands-on techniques, exercises, and education in a private, judgment-free setting.'
                        ],
                        [
                            'q' => 'Who should see a women\'s health physiotherapist?',
                            'a' => 'Anyone experiencing pelvic or related symptoms can benefit: pain during or after sex, leaking urine when laughing or exercising, persistent pelvic pain, discomfort during or after pregnancy, fear or pain around intimacy after childbirth, constipation or bowel issues, or the feeling that "something feels off" but tests come back normal. You don\'t need a referral in many cases—reaching out is the first step.'
                        ],
                        [
                            'q' => 'What happens in a women\'s health physio session?',
                            'a' => 'We start with a conversation to understand your story, goals, and any worries. If you\'re comfortable, we may do a physical assessment to check muscle function and sensitivity. Treatment typically includes gentle manual therapy, breathing and relaxation techniques, and tailored exercises. There are no scary instruments—everything is explained, and you\'re in control of what we do.'
                        ],
                        [
                            'q' => 'How many sessions will I need?',
                            'a' => 'It depends on your condition and goals. Some women see improvement in a few sessions; others benefit from a longer plan. After your first assessment, we’ll give you an idea of what to expect and how we’ll measure progress.'
                        ],
                        [
                            'q' => 'Is pelvic floor therapy covered by insurance?',
                            'a' => 'Coverage varies by insurer and policy. We recommend checking with your provider for "physiotherapy" or "women\'s health physiotherapy." We can provide documentation and receipts to support your claim.'
                        ],
                        // Pain & intimacy
                        [
                            'q' => 'Why does sex hurt even when I want it?',
                            'a' => 'It\'s often due to pelvic floor muscle tightness or overactivity, not something "in your head." Your body may be protecting itself from perceived threat or past pain. Physical therapy can help retrain these muscles to relax and respond normally, so intimacy can become comfortable again.'
                        ],
                        [
                            'q' => 'Is pain during sex normal?',
                            'a' => 'Common? Yes. Normal? No. Sex should not be painful. Pain is your body\'s signal that something needs attention. Treatable causes often include muscle tension, hormonal changes, scar tissue, or nerve sensitivity—all areas we can address.'
                        ],
                        [
                            'q' => 'Why does my body tense up during sex?',
                            'a' => 'This is often an involuntary protective response (sometimes called vaginismus), where muscles spasm to prevent anticipated pain. It\'s a reflex, not a choice. Gentle desensitization and pelvic floor relaxation techniques can help reverse this pattern.'
                        ],
                        [
                            'q' => 'Can physiotherapy really help with sexual pain?',
                            'a' => 'Yes. We treat the physical causes—tight muscles, scar tissue, or nerve sensitivity—using hands-on therapy, breathing work, and when appropriate, dilation or desensitization guidance. Many women regain comfortable intimacy with a structured, supportive approach.'
                        ],
                        [
                            'q' => 'Is it normal to fear sex after childbirth?',
                            'a' => 'Yes, especially if you had a tear, episiotomy, or traumatic birth. Fear of pain is natural. We can help you heal scar tissue, restore muscle function, and rebuild confidence so you can return to intimacy without fear.'
                        ],
                        // Bladder & incontinence
                        [
                            'q' => 'Why do I leak urine when I laugh?',
                            'a' => 'This is often stress incontinence—when weak or uncoordinated pelvic floor muscles can\'t handle the extra pressure from laughing, coughing, or exercise. Specialized exercises and sometimes lifestyle tweaks can significantly improve or resolve this.'
                        ],
                        [
                            'q' => 'I leak a little when I run or jump. Is that fixable?',
                            'a' => 'Often yes. Stress incontinence during high-impact activity is common and frequently improves with pelvic floor strengthening and coordination training under the guidance of a women\'s health physiotherapist.'
                        ],
                        // Pregnancy & postpartum
                        [
                            'q' => 'Is pain after childbirth normal or should I see someone?',
                            'a' => 'Some soreness is expected, but persistent pain weeks or months after delivery isn\'t "just part of being a mom." If pain affects your daily life, movement, or intimacy, a check-up with a women\'s health physio is worthwhile.'
                        ],
                        [
                            'q' => 'When should I worry about pelvic pain during pregnancy?',
                            'a' => 'If pain makes walking, turning in bed, or getting dressed difficult, it may be pelvic girdle pain (PGP). It\'s common but treatable—you don\'t have to "just put up with it" until birth. Safe, pregnancy-appropriate physiotherapy can help.'
                        ],
                        [
                            'q' => 'When can I start pelvic floor exercises after delivery?',
                            'a' => 'It depends on your delivery and any complications. We generally recommend an assessment first so we can tailor advice. Starting too early or with the wrong exercises can be unhelpful; starting at the right time can speed recovery.'
                        ],
                        // When tests are "normal"
                        [
                            'q' => 'I have pelvic pain but all my reports are normal. What\'s wrong?',
                            'a' => 'Medical tests rule out infections or structural problems but often don\'t assess muscle tension (hypertonicity). A pelvic physio can evaluate whether tight muscles or soft tissue are compressing nerves or contributing to your pain—and then treat accordingly.'
                        ],
                        [
                            'q' => 'I feel something is off but I can\'t explain it. Can I still come?',
                            'a' => 'Absolutely. You don\'t need a clear diagnosis or even the right words. Many women come with a sense that something isn\'t right. We\'re used to listening, asking the right questions, and helping you figure out the next steps.'
                        ],
                        // Privacy & safety
                        [
                            'q' => 'Is everything confidential?',
                            'a' => 'Yes. Your history, assessment, and treatment are confidential. We follow the same professional and ethical standards as other healthcare providers and will never share your information without your consent.'
                        ],
                        [
                            'q' => 'Still have questions?',
                            'a' => 'We\'re here to help. Reach out via our contact page or book a consultation. No question is too small or too personal—we\'ve heard it before and we\'re on your side.'
                        ],
                    ];
                    $mid = (int) ceil(count($faqs) / 2);
                    $faqsCol1 = array_slice($faqs, 0, $mid);
                    $faqsCol2 = array_slice($faqs, $mid);
                @endphp
                {{-- Column 1 --}}
                <div class="space-y-4">
                    @foreach($faqsCol1 as $i => $item)
                        @php $index = $i; @endphp
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-md group" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <button class="faq-trigger w-full flex items-start text-left p-5 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-inset rounded-xl" aria-expanded="false" aria-controls="faq-{{ $index }}" id="faq-btn-{{ $index }}" onclick="toggleFaqPage(this)">
                                <span class="text-pink-600 font-bold mr-3 text-base shrink-0 mt-0.5">{{ $index + 1 }}.</span>
                                <span class="text-gray-900 font-bold text-base flex-1 group-hover:text-pink-600 transition-colors text-left" itemprop="name">{{ $item['q'] }}</span>
                                <span class="ml-3 shrink-0 text-gray-400 transform transition-transform duration-200 faq-icon">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </span>
                            </button>
                            <div id="faq-{{ $index }}" class="faq-answer text-gray-600 text-sm leading-relaxed px-5 pb-5 pl-10 hidden border-t border-gray-100 mt-0 pt-3 transition-all duration-300 ease-in-out" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                <div itemprop="text">{{ $item['a'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Column 2 --}}
                <div class="space-y-4">
                    @foreach($faqsCol2 as $j => $item)
                        @php $index = $mid + $j; @endphp
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-md group" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <button class="faq-trigger w-full flex items-start text-left p-5 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-inset rounded-xl" aria-expanded="false" aria-controls="faq-{{ $index }}" id="faq-btn-{{ $index }}" onclick="toggleFaqPage(this)">
                                <span class="text-pink-600 font-bold mr-3 text-base shrink-0 mt-0.5">{{ $index + 1 }}.</span>
                                <span class="text-gray-900 font-bold text-base flex-1 group-hover:text-pink-600 transition-colors text-left" itemprop="name">{{ $item['q'] }}</span>
                                <span class="ml-3 shrink-0 text-gray-400 transform transition-transform duration-200 faq-icon">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </span>
                            </button>
                            <div id="faq-{{ $index }}" class="faq-answer text-gray-600 text-sm leading-relaxed px-5 pb-5 pl-10 hidden border-t border-gray-100 mt-0 pt-3 transition-all duration-300 ease-in-out" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                <div itemprop="text">{{ $item['a'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- CTA -->
            <div class="mt-14 text-center">
                <p class="text-gray-700 mb-6">Couldn't find your question? We're happy to talk.</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-pink-700 transition-colors shadow-md hover:shadow-lg">
                    Contact Us
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <script>
        function toggleFaqPage(button) {
            const id = button.getAttribute('aria-controls');
            const content = document.getElementById(id);
            const icon = button.querySelector('.faq-icon');
            const isOpen = button.getAttribute('aria-expanded') === 'true';
            if (isOpen) {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
                button.setAttribute('aria-expanded', 'false');
                button.parentElement.classList.remove('shadow-md');
                button.parentElement.classList.add('bg-gradient-to-r');
            } else {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
                button.setAttribute('aria-expanded', 'true');
                button.parentElement.classList.add('shadow-md');
                button.parentElement.classList.remove('bg-gradient-to-r');
                button.parentElement.classList.add('bg-white');
            }
        }
    </script>
@endsection
