<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceStructureSeeder extends Seeder
{
    public function run(): void
    {
        ServiceSubcategory::query()->delete();
        ServiceCategory::query()->delete();

        $cardColors = ['pink', 'rose', 'fuchsia', 'teal', 'purple', 'pink', 'rose', 'fuchsia', 'teal', 'purple'];

        $structure = [
            [
                'name' => 'Pelvic Floor & Bladder Health',
                'short_description' => 'Evidence-based assessment and treatment for bladder control, urine leakage, and pelvic floor strength. Expert women\'s health physiotherapy in Delhi NCR.',
                'meta_title' => 'Pelvic Floor & Bladder Health | Women\'s Health Physiotherapy Delhi NCR',
                'meta_description' => 'Treat urine leakage (stress, urge, mixed), urinary urgency, weak pelvic floor & postnatal bladder issues. Pelvic floor rehab & continence care at Pelvicare.',
                'meta_keywords' => 'pelvic floor rehab, continence rehab, women\'s health physio, urine leakage, stress incontinence, urge incontinence, bladder health, Delhi NCR',
                'backend_tags' => ['Pelvic Floor Rehabilitation', 'Continence Rehab', 'Women\'s Health Physiotherapy'],
                'subcategories' => [
                    ['name' => 'Urine leakage (stress / urge / mixed)', 'description' => 'Specialised physiotherapy for stress incontinence (leaking when you laugh, sneeze or cough), urge incontinence (sudden strong need to urinate), and mixed incontinence. Personalised pelvic floor and bladder training to improve control and confidence.', 'meta_title' => 'Urine Leakage Treatment | Stress & Urge Incontinence Physiotherapy', 'meta_description' => 'Evidence-based treatment for stress, urge and mixed urinary incontinence. Women\'s health physiotherapy that works.', 'meta_keywords' => 'stress incontinence, urge incontinence, urine leakage treatment, pelvic floor'],
                    ['name' => 'Urinary urgency & frequency / Difficulty in passing urine', 'description' => 'Assessment and treatment for overactive bladder, frequent urination, and difficulty emptying the bladder. Bladder training and pelvic floor coordination to restore normal bladder function.', 'meta_title' => 'Urinary Urgency & Frequency | Bladder Physiotherapy Delhi NCR', 'meta_description' => 'Treatment for urinary urgency, frequency and difficulty passing urine. Personalised bladder and pelvic floor rehab.', 'meta_keywords' => 'urinary urgency, frequency, bladder training, pelvic floor'],
                    ['name' => 'Weak pelvic floor', 'description' => 'Progressive strengthening and coordination programmes for weak pelvic floor muscles. Safe, evidence-based exercises tailored to your assessment—improving support, control and confidence.', 'meta_title' => 'Weak Pelvic Floor Treatment | Strengthening Physiotherapy', 'meta_description' => 'Pelvic floor strengthening and coordination for weak muscles. Personalised programmes at Pelvicare.', 'meta_keywords' => 'weak pelvic floor, pelvic floor strengthening, women\'s health'],
                    ['name' => 'Postnatal bladder issues', 'description' => 'Post-pregnancy bladder and pelvic floor rehabilitation. Address leaking, urgency or discomfort after childbirth with expert women\'s health physiotherapy.', 'meta_title' => 'Postnatal Bladder Issues | Postpartum Bladder Physiotherapy', 'meta_description' => 'Expert care for postnatal bladder and pelvic floor issues. Safe, effective postpartum rehab.', 'meta_keywords' => 'postnatal bladder, postpartum incontinence, pelvic floor after birth'],
                ],
            ],
            [
                'name' => 'Sexual & Intimate Health Rehabilitation',
                'short_description' => 'Respectful, evidence-based care for vaginismus, dyspareunia (pain during sex), and intimate health. Pelvic floor down-training and pelvic pain management.',
                'meta_title' => 'Sexual & Intimate Health Rehabilitation | Pelvicare Delhi NCR',
                'meta_description' => 'Treatment for vaginismus, pain during sex (dyspareunia), low sensation & tight pelvic floor. Intimate health rehab with compassion and expertise.',
                'meta_keywords' => 'pelvic pain, intimate health rehab, pelvic floor down-training, vaginismus, dyspareunia, pain during sex',
                'backend_tags' => ['Pelvic Pain Management', 'Intimate Health Rehab', 'Pelvic Floor Rehabilitation'],
                'subcategories' => [
                    ['name' => 'Vaginismus', 'description' => 'Specialised physiotherapy for vaginismus—involuntary tightening that makes penetration painful or impossible. Gentle, progressive desensitisation and pelvic floor relaxation in a safe, supportive environment.', 'meta_title' => 'Vaginismus Treatment | Pelvic Floor Physiotherapy', 'meta_description' => 'Evidence-based vaginismus treatment. Pelvic floor relaxation and desensitisation at Pelvicare.', 'meta_keywords' => 'vaginismus, pelvic floor relaxation, intimate health'],
                    ['name' => 'Dyspareunia (pain during sex)', 'description' => 'Assessment and treatment for pain during intercourse. We identify muscular, fascial or nervous system contributors and create a personalised plan to reduce pain and restore comfort.', 'meta_title' => 'Pain During Sex (Dyspareunia) | Women\'s Health Physiotherapy', 'meta_description' => 'Expert treatment for dyspareunia and pain during sex. Pelvic pain and intimate health rehab.', 'meta_keywords' => 'dyspareunia, pain during sex, pelvic pain'],
                    ['name' => 'Pain after intercourse', 'description' => 'Care for pain that occurs during or after intimacy. We address pelvic muscle tension, scar sensitivity and tissue mobility to support pain-free and comfortable experiences.', 'meta_title' => 'Pain After Intercourse | Pelvic Physiotherapy Treatment', 'meta_description' => 'Treatment for pain during or after intercourse. Personalised pelvic and intimate health care.', 'meta_keywords' => 'pain after sex, pelvic pain, intimate health'],
                    ['name' => 'Low sexual sensation', 'description' => 'Support for reduced sensation or awareness in the pelvic and intimate area. Education, pelvic floor awareness and safe exercises to improve connection and comfort.', 'meta_title' => 'Low Sexual Sensation | Pelvic Awareness Physiotherapy', 'meta_description' => 'Pelvic floor and sensation education. Support for low sexual sensation with expert guidance.', 'meta_keywords' => 'low sensation, pelvic awareness, intimate health'],
                    ['name' => 'Tight pelvic floor muscles', 'description' => 'Pelvic floor down-training and relaxation for hypertonic (overly tight) muscles. Manual therapy, breathing and progressive relaxation to restore balance and reduce pain.', 'meta_title' => 'Tight Pelvic Floor Treatment | Down-Training & Relaxation', 'meta_description' => 'Pelvic floor relaxation and down-training for tight muscles. Evidence-based care at Pelvicare.', 'meta_keywords' => 'tight pelvic floor, pelvic floor relaxation, down-training'],
                ],
            ],
            [
                'name' => 'Reproductive Health Rehabilitation',
                'short_description' => 'Pelvic pain management and support for PCOD/PCOS, painful periods, endometriosis and fertility-related discomfort. Women\'s health physiotherapy that listens.',
                'meta_title' => 'Reproductive Health Rehabilitation | Pelvic Pain & Women\'s Health',
                'meta_description' => 'Treatment for PCOD/PCOS pain, painful periods, endometriosis & pelvic pain with infertility. Evidence-based women\'s health physio.',
                'meta_keywords' => 'pelvic pain management, women\'s health physio, PCOD, PCOS, endometriosis, painful periods',
                'backend_tags' => ['Pelvic Pain Management', 'Women\'s Health Physiotherapy'],
                'subcategories' => [
                    ['name' => 'PCOD / PCOS-related pain & dysfunction', 'description' => 'Physiotherapy support for pain and dysfunction associated with PCOD/PCOS. Exercise prescription, pain education and pelvic care tailored to your cycle and symptoms.', 'meta_title' => 'PCOD PCOS Pain & Dysfunction | Women\'s Health Physiotherapy', 'meta_description' => 'Pelvic and musculoskeletal support for PCOD/PCOS. Safe exercise and pain management.', 'meta_keywords' => 'PCOD, PCOS, pelvic pain, women\'s health'],
                    ['name' => 'Irregular or painful periods', 'description' => 'Support for menstrual pain (dysmenorrhea) and irregular cycles. Pelvic release, core stability and lifestyle guidance to improve comfort and function around your period.', 'meta_title' => 'Painful Periods Treatment | Menstrual Pain Physiotherapy', 'meta_description' => 'Physiotherapy for painful and irregular periods. Pelvic and abdominal care.', 'meta_keywords' => 'painful periods, dysmenorrhea, menstrual pain'],
                    ['name' => 'Endometriosis-related pain', 'description' => 'Gentle, evidence-based care for pelvic and abdominal pain linked to endometriosis. Pain neuroscience education, relaxation and movement strategies to improve daily function.', 'meta_title' => 'Endometriosis Pain Treatment | Pelvic Physiotherapy', 'meta_description' => 'Support for endometriosis-related pelvic pain. Pain education and gentle rehab.', 'meta_keywords' => 'endometriosis, pelvic pain, pain management'],
                    ['name' => 'Pelvic pain associated with infertility', 'description' => 'Pelvic and emotional support for women experiencing pelvic pain alongside fertility challenges. Manual therapy, relaxation and coping strategies in a supportive setting.', 'meta_title' => 'Pelvic Pain & Infertility | Women\'s Health Physiotherapy', 'meta_description' => 'Pelvic pain support during fertility journey. Compassionate women\'s health care.', 'meta_keywords' => 'infertility, pelvic pain, women\'s health physio'],
                ],
            ],
            [
                'name' => 'Pregnancy Care & Rehabilitation',
                'short_description' => 'Pregnancy physiotherapy for back pain, pelvic girdle pain, sciatica and safe exercise. Labour preparation and body conditioning for expectant mothers.',
                'meta_title' => 'Pregnancy Care & Rehabilitation | Pregnancy Physiotherapy Delhi NCR',
                'meta_description' => 'Pregnancy back pain, pelvic girdle pain, sciatica & safe exercise. Labour preparation and pregnancy physio at Pelvicare.',
                'meta_keywords' => 'pregnancy physio, orthopedic, women\'s health, pregnancy back pain, pelvic girdle pain',
                'backend_tags' => ['Pregnancy & Postpartum Physiotherapy', 'Orthopedic', 'Women\'s Health Physiotherapy'],
                'subcategories' => [
                    ['name' => 'Pregnancy-related back pain', 'description' => 'Safe, effective treatment for back pain during pregnancy. Manual therapy, posture advice and pregnancy-appropriate exercises to keep you mobile and comfortable.', 'meta_title' => 'Pregnancy Back Pain | Pregnancy Physiotherapy Delhi NCR', 'meta_description' => 'Treatment for back pain in pregnancy. Safe, evidence-based pregnancy physio.', 'meta_keywords' => 'pregnancy back pain, pregnancy physiotherapy'],
                    ['name' => 'Pelvic girdle pain', 'description' => 'Specialised care for pelvic girdle pain (PGP) in pregnancy. Stabilisation, support and movement strategies to reduce pain and improve daily function.', 'meta_title' => 'Pelvic Girdle Pain in Pregnancy | Physiotherapy Treatment', 'meta_description' => 'Expert care for pelvic girdle pain during pregnancy. Safe rehab and support.', 'meta_keywords' => 'pelvic girdle pain, pregnancy, PGP'],
                    ['name' => 'Sciatica during pregnancy', 'description' => 'Assessment and treatment for sciatica and nerve-related leg pain in pregnancy. Gentle manual therapy and exercises to ease symptoms safely.', 'meta_title' => 'Sciatica During Pregnancy | Pregnancy Physiotherapy', 'meta_description' => 'Sciatica and leg pain in pregnancy. Safe, gentle physiotherapy care.', 'meta_keywords' => 'sciatica pregnancy, leg pain pregnancy'],
                    ['name' => 'Pregnancy fitness & safe exercise', 'description' => 'Individualised pregnancy fitness and safe exercise programmes. Build strength, stamina and confidence while respecting your changing body and stage of pregnancy.', 'meta_title' => 'Pregnancy Fitness & Safe Exercise | Pelvicare', 'meta_description' => 'Safe exercise and fitness during pregnancy. Expert guidance for expectant mothers.', 'meta_keywords' => 'pregnancy fitness, safe exercise pregnancy'],
                    ['name' => 'Labour preparation & body conditioning', 'description' => 'Prepare your body for labour with pelvic mobility, breathing and positioning education. Body conditioning to support a more comfortable and confident birth experience.', 'meta_title' => 'Labour Preparation | Body Conditioning for Birth', 'meta_description' => 'Labour preparation and body conditioning. Pelvicare pregnancy physiotherapy.', 'meta_keywords' => 'labour preparation, birth preparation, pregnancy'],
                ],
            ],
            [
                'name' => 'Postpartum Recovery & Rehabilitation',
                'short_description' => 'Postnatal rehab for C-section and episiotomy scars, diastasis recti, perineal pain and return to fitness. Expert postpartum and core rehab at Pelvicare.',
                'meta_title' => 'Postpartum Recovery & Rehabilitation | Postnatal Physiotherapy Delhi NCR',
                'meta_description' => 'C-section & episiotomy scar care, diastasis recti, perineal pain & return to fitness. Postnatal and pelvic floor rehab.',
                'meta_keywords' => 'postnatal rehab, core rehab, pelvic floor rehab, C-section scar, diastasis recti, postpartum',
                'backend_tags' => ['Post Surgery', 'Pregnancy & Postpartum Physiotherapy', 'Pelvic Floor Rehabilitation'],
                'subcategories' => [
                    ['name' => 'C-section & episiotomy scar management', 'description' => 'Specialised scar therapy for C-section and episiotomy scars. Scar mobilisation, desensitisation and tissue mobility to restore comfort, movement and confidence.', 'meta_title' => 'C-Section & Episiotomy Scar Treatment | Postnatal Physiotherapy', 'meta_description' => 'Scar management after C-section and episiotomy. Expert postnatal rehab.', 'meta_keywords' => 'C-section scar, episiotomy scar, scar therapy'],
                    ['name' => 'Diastasis recti rehabilitation', 'description' => 'Safe, effective rehabilitation for diastasis recti (abdominal separation) after childbirth. Core retraining and progressive strengthening to restore function and confidence.', 'meta_title' => 'Diastasis Recti Treatment | Postpartum Core Rehab', 'meta_description' => 'Diastasis recti rehab after pregnancy. Evidence-based core rehabilitation.', 'meta_keywords' => 'diastasis recti, postpartum core, abdominal separation'],
                    ['name' => 'Perineal pain', 'description' => 'Assessment and treatment for perineal pain after birth. Scar care, pelvic floor relaxation and gentle progressions toward pain-free sitting, movement and intimacy.', 'meta_title' => 'Perineal Pain After Birth | Postnatal Physiotherapy', 'meta_description' => 'Treatment for perineal pain postpartum. Gentle, effective postnatal care.', 'meta_keywords' => 'perineal pain, postpartum pain'],
                    ['name' => 'Postnatal body strengthening', 'description' => 'Progressive postnatal strengthening programmes. Restore core, pelvic floor and overall strength safely after delivery—whether vaginal or C-section.', 'meta_title' => 'Postnatal Body Strengthening | Postpartum Physiotherapy', 'meta_description' => 'Postnatal strengthening and recovery. Safe programmes for new mothers.', 'meta_keywords' => 'postnatal strengthening, postpartum fitness'],
                    ['name' => 'Return to fitness after childbirth', 'description' => 'Guided return to exercise and fitness after having a baby. Personalised progression from early postpartum to running, gym and sport—when your body is ready.', 'meta_title' => 'Return to Fitness After Childbirth | Pelvicare', 'meta_description' => 'Safe return to fitness after childbirth. Expert guidance for new mothers.', 'meta_keywords' => 'return to fitness, postpartum exercise'],
                ],
            ],
            [
                'name' => 'Pelvic Pain Management',
                'short_description' => 'Deep pelvic pain, perineal pain, scar-related and chronic pelvic pain. Myofascial release and women\'s health physiotherapy for pain with sitting or movement.',
                'meta_title' => 'Pelvic Pain Management | Chronic Pelvic Pain Physiotherapy Delhi NCR',
                'meta_description' => 'Treatment for deep pelvic pain, perineal pain, scar pain & chronic pelvic pain. Myofascial release and women\'s health physio.',
                'meta_keywords' => 'pelvic pain, myofascial release, women\'s health physio, chronic pelvic pain',
                'backend_tags' => ['Pelvic Pain Management', 'Women\'s Health Physiotherapy'],
                'subcategories' => [
                    ['name' => 'Deep pelvic pain', 'description' => 'Assessment and treatment for deep pelvic pain. We use internal and external manual therapy, relaxation and education to address muscle, fascial and nervous system contributors.', 'meta_title' => 'Deep Pelvic Pain Treatment | Women\'s Health Physiotherapy', 'meta_description' => 'Expert care for deep pelvic pain. Manual therapy and pain education.', 'meta_keywords' => 'deep pelvic pain, pelvic pain treatment'],
                    ['name' => 'Perineal pain', 'description' => 'Targeted care for perineal pain—whether from childbirth, surgery or other causes. Scar and tissue work, pelvic floor down-training and desensitisation.', 'meta_title' => 'Perineal Pain Treatment | Pelvic Physiotherapy', 'meta_description' => 'Treatment for perineal pain. Gentle, evidence-based care.', 'meta_keywords' => 'perineal pain, pelvic pain'],
                    ['name' => 'Scar-related pelvic pain', 'description' => 'Scar tissue mobilisation and desensitisation for pelvic and abdominal scars that contribute to pain. Restore comfort and mobility around old or recent scars.', 'meta_title' => 'Scar-Related Pelvic Pain | Scar Therapy Physiotherapy', 'meta_description' => 'Scar therapy for pelvic and abdominal pain. Expert scar mobilisation.', 'meta_keywords' => 'scar pain, scar therapy, pelvic pain'],
                    ['name' => 'Chronic pelvic pain', 'description' => 'Comprehensive approach to chronic pelvic pain. Pain neuroscience education, manual therapy, relaxation and pacing strategies to improve function and quality of life.', 'meta_title' => 'Chronic Pelvic Pain Treatment | Pelvicare Delhi NCR', 'meta_description' => 'Chronic pelvic pain management. Multimodal, evidence-based care.', 'meta_keywords' => 'chronic pelvic pain, pelvic pain management'],
                    ['name' => 'Pain with sitting or movement', 'description' => 'Assessment and treatment for pain that worsens with sitting or specific movements. Posture, ergonomics and targeted rehab to support pain-free daily activities.', 'meta_title' => 'Pain with Sitting or Movement | Pelvic Physiotherapy', 'meta_description' => 'Treatment for sitting and movement-related pelvic pain. Practical solutions.', 'meta_keywords' => 'sitting pain, movement pain, pelvic pain'],
                ],
            ],
            [
                'name' => 'Bowel Health Issues',
                'short_description' => 'Pelvic floor and bowel rehab for constipation, faecal incontinence, piles (supportive care) and difficulty with bowel evacuation. Expert bowel & bladder rehab.',
                'meta_title' => 'Bowel Health Issues | Pelvic Floor & Bowel Physiotherapy Delhi NCR',
                'meta_description' => 'Treatment for constipation, stool leakage, piles (supportive rehab) & bowel evacuation difficulty. Pelvic floor and bowel rehab at Pelvicare.',
                'meta_keywords' => 'pelvic floor rehab, bowel bladder rehab, constipation, faecal incontinence',
                'backend_tags' => ['Pelvic Floor Rehabilitation', 'Women\'s Health Physiotherapy'],
                'subcategories' => [
                    ['name' => 'Constipation', 'description' => 'Physiotherapy for constipation related to pelvic floor dysfunction. Bowel education, toileting posture and pelvic floor coordination to support regular, comfortable evacuation.', 'meta_title' => 'Constipation Treatment | Pelvic Floor Physiotherapy', 'meta_description' => 'Pelvic floor and bowel rehab for constipation. Evidence-based care.', 'meta_keywords' => 'constipation, pelvic floor, bowel rehab'],
                    ['name' => 'Stool leakage (faecal incontinence)', 'description' => 'Assessment and treatment for faecal incontinence. Pelvic floor strengthening, bowel training and lifestyle strategies to improve control and confidence.', 'meta_title' => 'Faecal Incontinence Treatment | Bowel Physiotherapy', 'meta_description' => 'Treatment for stool leakage and faecal incontinence. Pelvic floor rehab.', 'meta_keywords' => 'faecal incontinence, stool leakage, pelvic floor'],
                    ['name' => 'Piles (haemorrhoids) - supportive rehab', 'description' => 'Supportive rehabilitation alongside medical care for piles/haemorrhoids. Pelvic floor coordination, bowel habits and posture to reduce strain and support recovery.', 'meta_title' => 'Piles Haemorrhoids Supportive Rehab | Pelvicare', 'meta_description' => 'Supportive rehab for piles and haemorrhoids. Pelvic floor and bowel care.', 'meta_keywords' => 'piles, haemorrhoids, pelvic floor'],
                    ['name' => 'Difficulty with bowel evacuation', 'description' => 'Care for difficulty emptying the bowels (e.g. straining, incomplete evacuation). Pelvic floor relaxation, positioning and coordination training for easier, complete evacuation.', 'meta_title' => 'Bowel Evacuation Difficulty | Pelvic Physiotherapy', 'meta_description' => 'Treatment for difficulty with bowel evacuation. Pelvic floor and bowel rehab.', 'meta_keywords' => 'bowel evacuation, pelvic floor, constipation'],
                ],
            ],
            [
                'name' => 'Back & Musculoskeletal Pain in Women',
                'short_description' => 'Orthopedic and manual therapy for back pain, tailbone pain (coccydynia), sciatica, knee pain and postural pain. Pain management tailored to women.',
                'meta_title' => 'Back & Musculoskeletal Pain in Women | Physiotherapy Delhi NCR',
                'meta_description' => 'Treatment for back pain, tailbone pain (coccydynia), sciatica, knee pain & postural pain. Orthopedic and manual therapy at Pelvicare.',
                'meta_keywords' => 'orthopedic, manual therapy, pain management, back pain, coccydynia, sciatica',
                'backend_tags' => ['Orthopedic', 'Back Pain', 'Women\'s Health Physiotherapy'],
                'subcategories' => [
                    ['name' => 'Back pain', 'description' => 'Assessment and treatment for back pain in women. Manual therapy, core stability and posture retraining to reduce pain and improve function.', 'meta_title' => 'Back Pain Treatment for Women | Physiotherapy Delhi NCR', 'meta_description' => 'Back pain treatment tailored to women. Manual therapy and rehab.', 'meta_keywords' => 'back pain, women\'s health, physiotherapy'],
                    ['name' => 'Tailbone pain (coccydynia)', 'description' => 'Specialised care for tailbone pain (coccydynia). Manual therapy, seating advice and pelvic floor coordination to ease sitting and daily activities.', 'meta_title' => 'Tailbone Pain Coccydynia Treatment | Pelvicare', 'meta_description' => 'Treatment for tailbone pain and coccydynia. Expert manual therapy.', 'meta_keywords' => 'coccydynia, tailbone pain'],
                    ['name' => 'Sciatica', 'description' => 'Assessment and treatment for sciatica and nerve-related leg pain. Manual therapy, neural mobility and exercise to reduce pain and improve function.', 'meta_title' => 'Sciatica Treatment | Women\'s Health Physiotherapy', 'meta_description' => 'Sciatica treatment for women. Evidence-based physiotherapy care.', 'meta_keywords' => 'sciatica, leg pain, physiotherapy'],
                    ['name' => 'Knee pain', 'description' => 'Knee pain assessment and rehabilitation. Strengthening, movement retraining and load management tailored to women\'s biomechanics and goals.', 'meta_title' => 'Knee Pain Treatment | Physiotherapy for Women', 'meta_description' => 'Knee pain treatment for women. Orthopedic and functional rehab.', 'meta_keywords' => 'knee pain, women\'s health'],
                    ['name' => 'Postural pain in women', 'description' => 'Assessment and treatment for pain related to posture—desk work, standing, or daily habits. Ergonomic advice, strengthening and movement retraining.', 'meta_title' => 'Postural Pain Treatment | Physiotherapy Delhi NCR', 'meta_description' => 'Postural pain treatment for women. Ergonomic and movement rehab.', 'meta_keywords' => 'postural pain, posture, physiotherapy'],
                ],
            ],
            [
                'name' => 'Menopause Care',
                'short_description' => 'Pelvic floor rehab and women\'s health physiotherapy for vaginal laxity, pelvic organ prolapse (supportive), urinary symptoms and pelvic floor weakness in menopause.',
                'meta_title' => 'Menopause Care | Pelvic Floor & Women\'s Health Physiotherapy',
                'meta_description' => 'Vaginal laxity, pelvic organ prolapse (supportive), urinary symptoms & pelvic floor weakness in menopause. Expert care at Pelvicare.',
                'meta_keywords' => 'pelvic floor rehab, women\'s health physio, menopause, prolapse',
                'backend_tags' => ['Pelvic Floor Rehabilitation', 'Women\'s Health Physiotherapy'],
                'subcategories' => [
                    ['name' => 'Vaginal laxity', 'description' => 'Supportive care for vaginal laxity and sensation changes. Pelvic floor strengthening, awareness and lifestyle guidance in a respectful, evidence-based approach.', 'meta_title' => 'Vaginal Laxity | Pelvic Floor Physiotherapy Menopause', 'meta_description' => 'Pelvic floor care for vaginal laxity. Women\'s health physio in menopause.', 'meta_keywords' => 'vaginal laxity, menopause, pelvic floor'],
                    ['name' => 'Pelvic organ prolapse (supportive rehab)', 'description' => 'Supportive rehabilitation for pelvic organ prolapse. Pelvic floor training, posture and lifestyle strategies to improve support and confidence—alongside your medical care.', 'meta_title' => 'Pelvic Organ Prolapse Supportive Rehab | Pelvicare', 'meta_description' => 'Supportive rehab for pelvic organ prolapse. Pelvic floor and lifestyle care.', 'meta_keywords' => 'prolapse, pelvic floor, menopause'],
                    ['name' => 'Urinary symptoms in menopause', 'description' => 'Assessment and treatment for urinary changes in menopause—leakage, urgency or frequency. Pelvic floor and bladder training tailored to your life stage.', 'meta_title' => 'Urinary Symptoms in Menopause | Women\'s Health Physiotherapy', 'meta_description' => 'Treatment for urinary symptoms in menopause. Pelvic floor and bladder rehab.', 'meta_keywords' => 'menopause, urinary symptoms, pelvic floor'],
                    ['name' => 'Pelvic floor weakness after menopause', 'description' => 'Pelvic floor strengthening and support after menopause. Personalised programmes to improve strength, control and confidence in daily life.', 'meta_title' => 'Pelvic Floor Weakness After Menopause | Pelvicare', 'meta_description' => 'Pelvic floor rehab after menopause. Evidence-based women\'s health care.', 'meta_keywords' => 'menopause, pelvic floor weakness'],
                ],
            ],
            [
                'name' => 'Weight & Lifestyle-Related Rehab',
                'short_description' => 'Functional rehab and strengthening for obesity-related joint pain, core weakness, movement difficulty and safe exercise guidance. Women\'s health at every size.',
                'meta_title' => 'Weight & Lifestyle-Related Rehab | Women\'s Health Physiotherapy',
                'meta_description' => 'Treatment for obesity-related joint pain, core weakness, movement difficulty & safe exercise. Functional rehab at Pelvicare.',
                'meta_keywords' => 'functional rehab, strengthening, women\'s health, safe exercise',
                'backend_tags' => ['Women\'s Health Physiotherapy'],
                'subcategories' => [
                    ['name' => 'Obesity-related joint pain', 'description' => 'Assessment and treatment for joint pain related to weight. Load management, strengthening and movement strategies to reduce pain and improve mobility.', 'meta_title' => 'Obesity-Related Joint Pain | Physiotherapy Delhi NCR', 'meta_description' => 'Joint pain treatment with weight in mind. Safe, effective rehab.', 'meta_keywords' => 'joint pain, weight, physiotherapy'],
                    ['name' => 'Core weakness', 'description' => 'Progressive core strengthening programmes. Build deep core and pelvic floor coordination for better support, posture and confidence in daily activities.', 'meta_title' => 'Core Weakness Treatment | Strengthening Physiotherapy', 'meta_description' => 'Core strengthening and rehabilitation. Personalised programmes.', 'meta_keywords' => 'core weakness, core strengthening'],
                    ['name' => 'Movement difficulty due to weight', 'description' => 'Support for movement and mobility when weight affects daily function. Safe, progressive exercise and activity pacing to improve confidence and participation.', 'meta_title' => 'Movement Difficulty | Functional Rehab Pelvicare', 'meta_description' => 'Movement and mobility support. Safe, respectful rehab.', 'meta_keywords' => 'movement difficulty, functional rehab'],
                    ['name' => 'Safe exercise guidance', 'description' => 'Individualised safe exercise and activity guidance. Build fitness and strength at your pace, with consideration for pelvic health, joints and overall wellbeing.', 'meta_title' => 'Safe Exercise Guidance | Women\'s Health Physiotherapy', 'meta_description' => 'Safe exercise and activity guidance. Expert support at Pelvicare.', 'meta_keywords' => 'safe exercise, women\'s health'],
                ],
            ],
        ];

        foreach ($structure as $index => $catData) {
            $subs = $catData['subcategories'];
            unset($catData['subcategories']);

            $category = ServiceCategory::create([
                'name' => $catData['name'],
                'slug' => Str::slug($catData['name']),
                'short_description' => $catData['short_description'],
                'meta_title' => $catData['meta_title'] ?? null,
                'meta_description' => $catData['meta_description'] ?? null,
                'meta_keywords' => $catData['meta_keywords'] ?? null,
                'backend_tags' => $catData['backend_tags'] ?? null,
                'card_color' => $cardColors[$index] ?? 'pink',
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($subs as $i => $subData) {
                ServiceSubcategory::create([
                    'service_category_id' => $category->id,
                    'name' => $subData['name'],
                    'slug' => Str::slug($subData['name']),
                    'description' => $subData['description'] ?? null,
                    'meta_title' => $subData['meta_title'] ?? null,
                    'meta_description' => $subData['meta_description'] ?? null,
                    'meta_keywords' => $subData['meta_keywords'] ?? null,
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
