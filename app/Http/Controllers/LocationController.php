<?php

namespace App\Http\Controllers;

use App\Models\Service;

class LocationController extends Controller
{
    private function allCities(): array
    {
        return [
            'amman' => [
                'slug'       => 'amman',
                'name_en'    => 'Amman',
                'name_ar'    => 'عمّان',
                'region_en'  => 'Capital Governorate',
                'region_ar'  => 'محافظة العاصمة',
                'flag'       => '🏙',
                'lat'        => 31.9539,
                'lng'        => 35.9106,
                'pop_en'     => '4.5 million+',
                'pop_ar'     => 'أكثر من 4.5 مليون',
                'tagline_en' => 'Jordan\'s Capital — Where Enterprise Meets Innovation',
                'tagline_ar' => 'عاصمة الأردن — حيث تلتقي المؤسسات بالابتكار',
                'intro_en'   => 'Amman is the financial, technological, and cultural capital of Jordan. Home to the largest concentration of tech companies, banks, hospitals, and e-commerce businesses in the region, Amman is where Alien Code was born — and where we deliver the most projects. Whether you\'re a startup in Abdali, an enterprise in Shmeisani, or an e-commerce store serving all of Jordan, our Amman-based team builds software that matches the speed and ambition of the city.',
                'intro_ar'   => 'عمّان هي العاصمة المالية والتكنولوجية والثقافية للأردن. إنها موطن أكبر تجمع لشركات التقنية والبنوك والمستشفيات وشركات التجارة الإلكترونية في المنطقة، وهي المدينة التي وُلدت فيها Alien Code — والمدينة التي ننجز فيها معظم مشاريعنا. سواء كنت شركة ناشئة في عبدالي أو مؤسسة كبيرة في شميساني أو متجراً إلكترونياً يخدم الأردن كله، فريقنا يبني البرمجيات التي تتناسب مع سرعة وطموح المدينة.',
                'sectors_en' => ['Banking & Finance', 'Healthcare & Clinics', 'E-commerce & Retail', 'Real Estate', 'Government & NGOs', 'Education & EdTech'],
                'sectors_ar' => ['البنوك والمالية', 'الرعاية الصحية والعيادات', 'التجارة الإلكترونية', 'العقارات', 'الحكومة والمنظمات', 'التعليم وتقنية التعليم'],
                'why_en'     => [
                    '🏢 Our headquarters is in Amman — we meet clients in person, every step of the way.',
                    '⚡ We can start your Amman project within 48 hours of signing.',
                    '🌍 We understand Amman\'s multilingual, multimarket business environment.',
                ],
                'why_ar'     => [
                    '🏢 مقرنا الرئيسي في عمّان — نلتقي بالعملاء وجهاً لوجه في كل مرحلة.',
                    '⚡ يمكننا بدء مشروعك في عمّان خلال 48 ساعة من التوقيع.',
                    '🌍 نفهم بيئة الأعمال متعددة اللغات والأسواق في عمّان.',
                ],
                'faqs_en'    => [
                    ['q' => 'Does Alien Code have an office in Amman?',              'a' => 'Yes. Our main office is in Amman. We hold in-person discovery sessions, design reviews, and demos for our Amman clients.'],
                    ['q' => 'What industries do you serve in Amman?',                 'a' => 'We serve fintech, healthcare, e-commerce, real estate, logistics, education, and government sectors across Amman.'],
                    ['q' => 'Can a small Amman business afford custom software?',     'a' => 'Yes. We build projects starting from a few hundred JD for simple tools and scale up to enterprise platforms. We tailor proposals to fit your budget.'],
                ],
                'faqs_ar'    => [
                    ['q' => 'هل لديكم مكتب في عمّان؟',                              'a' => 'نعم. مكتبنا الرئيسي في عمّان. نعقد جلسات استكشاف ومراجعات تصميم وعروض تقديمية وجهاً لوجه لعملائنا في عمّان.'],
                    ['q' => 'ما القطاعات التي تخدمونها في عمّان؟',                  'a' => 'نخدم قطاعات التقنية المالية والرعاية الصحية والتجارة الإلكترونية والعقارات والخدمات اللوجستية والتعليم والقطاع الحكومي في عمّان.'],
                    ['q' => 'هل تستطيع شركة صغيرة في عمّان تحمّل تكاليف برمجيات مخصصة؟', 'a' => 'نعم. نبني مشاريع تبدأ من بضع مئات من الدينارات للأدوات البسيطة، وتصل إلى منصات مؤسسية كاملة. نُكيّف العروض لتناسب ميزانيتك.'],
                ],
            ],
            'zarqa' => [
                'slug'       => 'zarqa',
                'name_en'    => 'Zarqa',
                'name_ar'    => 'الزرقاء',
                'region_en'  => 'Zarqa Governorate',
                'region_ar'  => 'محافظة الزرقاء',
                'flag'       => '🏭',
                'lat'        => 32.0636,
                'lng'        => 36.0878,
                'pop_en'     => '1.5 million+',
                'pop_ar'     => 'أكثر من 1.5 مليون',
                'tagline_en' => 'Jordan\'s Industrial Capital — Software That Powers Manufacturing',
                'tagline_ar' => 'عاصمة الصناعة الأردنية — برمجيات تُشغّل التصنيع',
                'intro_en'   => 'Zarqa is Jordan\'s industrial powerhouse. As home to major manufacturing complexes, the Zarqa Free Zone, and a dense SME ecosystem, Zarqa businesses demand robust inventory systems, factory floor automation, and ERP platforms that handle the complexity of industrial operations. Alien Code builds production-grade software tailored to Zarqa\'s manufacturing, trading, and logistics companies.',
                'intro_ar'   => 'الزرقاء هي المركز الصناعي الأقوى في الأردن. بوصفها موطناً للمجمعات الصناعية الكبرى ومنطقة الزرقاء الحرة ونظام كثيف من الشركات الصغيرة والمتوسطة، تحتاج شركات الزرقاء إلى أنظمة مخزون متينة وأتمتة لخطوط الإنتاج ومنصات ERP تتعامل مع تعقيدات العمليات الصناعية. تبني Alien Code برمجيات احترافية مخصصة لشركات التصنيع والتجارة والخدمات اللوجستية في الزرقاء.',
                'sectors_en' => ['Manufacturing & Factories', 'Free Zone Trading', 'Wholesale & Distribution', 'Logistics & Warehousing', 'Automotive Services', 'Construction'],
                'sectors_ar' => ['التصنيع والمصانع', 'تجارة المنطقة الحرة', 'الجملة والتوزيع', 'اللوجستيات والمستودعات', 'خدمات السيارات', 'البناء والمقاولات'],
                'why_en'     => [
                    '🏭 Deep experience in manufacturing ERP, inventory, and production-floor systems.',
                    '🔗 We integrate with barcode scanners, weighbridges, and industrial IoT devices.',
                    '📦 Zarqa\'s trading companies trust us for wholesale, distribution, and freight software.',
                ],
                'why_ar'     => [
                    '🏭 خبرة عميقة في أنظمة ERP التصنيعية والمخزون وإدارة خطوط الإنتاج.',
                    '🔗 ندمج الأنظمة مع قراء الباركود وجسور الوزن وأجهزة IoT الصناعية.',
                    '📦 تثق شركات التجارة في الزرقاء بحلولنا للجملة والتوزيع والشحن.',
                ],
                'faqs_en'    => [
                    ['q' => 'Do you build manufacturing ERP systems for Zarqa factories?', 'a' => 'Yes. We build complete manufacturing ERP systems covering production planning, raw materials, work-in-progress tracking, finished goods inventory, and shipping.'],
                    ['q' => 'Can you integrate software with factory machines in Zarqa?',  'a' => 'Yes. We integrate with PLCs, barcode scanners, RFID readers, and other industrial devices via APIs and serial/USB protocols.'],
                    ['q' => 'Do you visit Zarqa for project meetings?',                    'a' => 'Absolutely. Our team regularly visits clients in Zarqa for on-site discovery sessions and system demonstrations.'],
                ],
                'faqs_ar'    => [
                    ['q' => 'هل تبنون أنظمة ERP للمصانع في الزرقاء؟', 'a' => 'نعم. نبني أنظمة ERP تصنيعية متكاملة تشمل تخطيط الإنتاج والمواد الخام وتتبع قيد التصنيع ومخزون المنتجات النهائية والشحن.'],
                    ['q' => 'هل تستطيعون دمج البرمجيات مع آلات المصنع؟', 'a' => 'نعم. ندمج مع وحدات PLC وقراء الباركود وقراء RFID والأجهزة الصناعية الأخرى عبر APIs وبروتوكولات Serial/USB.'],
                    ['q' => 'هل تزورون الزرقاء لاجتماعات المشاريع؟', 'a' => 'بالتأكيد. يزور فريقنا بانتظام العملاء في الزرقاء لجلسات الاستكشاف الميدانية وعروض الأنظمة.'],
                ],
            ],
            'irbid' => [
                'slug'       => 'irbid',
                'name_en'    => 'Irbid',
                'name_ar'    => 'إربد',
                'region_en'  => 'Irbid Governorate',
                'region_ar'  => 'محافظة إربد',
                'flag'       => '🎓',
                'lat'        => 32.5556,
                'lng'        => 35.8500,
                'pop_en'     => '1.2 million+',
                'pop_ar'     => 'أكثر من 1.2 مليون',
                'tagline_en' => 'Jordan\'s University City — Technology for Education & Innovation',
                'tagline_ar' => 'مدينة الجامعات الأردنية — تقنية للتعليم والابتكار',
                'intro_en'   => 'Irbid is home to the largest concentration of universities in Jordan — including Yarmouk University and Jordan University of Science and Technology (JUST). This academic density drives a thriving ecosystem of student startups, edtech ventures, healthcare providers (supported by JUST\'s medical campus), and SMEs. Alien Code serves Irbid\'s unique mix of educational institutions, medical facilities, and growing tech community with custom software that keeps pace with innovation.',
                'intro_ar'   => 'إربد موطن لأكبر تجمع من الجامعات في الأردن، بما فيها جامعة اليرموك وجامعة العلوم والتقنية الأردنية (JUST). هذا التجمع الأكاديمي يدفع نظاماً بيئياً نابضاً من الشركات الناشئة الطلابية ومشاريع تقنية التعليم ومقدمي الرعاية الصحية والشركات الصغيرة والمتوسطة. تخدم Alien Code المزيج الفريد من المؤسسات التعليمية والمرافق الطبية ومجتمع التقنية المتنامي في إربد ببرمجيات مخصصة تواكب الابتكار.',
                'sectors_en' => ['Universities & Schools', 'Hospitals & Medical Centers', 'Student Startups', 'Agriculture Tech', 'Retail & Pharmacies', 'Government Services'],
                'sectors_ar' => ['الجامعات والمدارس', 'المستشفيات والمراكز الطبية', 'الشركات الناشئة الطلابية', 'تقنية الزراعة', 'التجزئة والصيدليات', 'الخدمات الحكومية'],
                'why_en'     => [
                    '🎓 We build learning management systems (LMS) and academic portals tailored for Irbid\'s universities.',
                    '🏥 Medical software expertise — JUST\'s hospital network and private clinics in Irbid are among our clients.',
                    '💡 We mentor student startup teams in Irbid and offer startup-friendly pricing.',
                ],
                'why_ar'     => [
                    '🎓 نبني أنظمة إدارة التعلم (LMS) والبوابات الأكاديمية المخصصة لجامعات إربد.',
                    '🏥 خبرة في البرمجيات الطبية — شبكة مستشفيات JUST والعيادات الخاصة في إربد من عملائنا.',
                    '💡 نتمنتر فرق الشركات الناشئة الطلابية في إربد ونقدم أسعاراً ملائمة للشركات الناشئة.',
                ],
                'faqs_en'    => [
                    ['q' => 'Do you build university portals and LMS for Irbid institutions?', 'a' => 'Yes. We have experience building student portals, faculty management systems, online exam platforms, and full LMS solutions for universities.'],
                    ['q' => 'Can student startups in Irbid afford Alien Code\'s services?',   'a' => 'Yes. We have a startup track with flexible payment plans and MVP-focused scopes specifically designed for early-stage ventures.'],
                    ['q' => 'Do you work with medical facilities in Irbid?',                  'a' => 'Yes. We build clinic management, patient record (EMR), appointment, and billing systems for medical providers in Irbid and northern Jordan.'],
                ],
                'faqs_ar'    => [
                    ['q' => 'هل تبنون بوابات جامعية وأنظمة LMS لمؤسسات إربد؟', 'a' => 'نعم. لدينا خبرة في بناء بوابات الطلاب وأنظمة إدارة أعضاء هيئة التدريس ومنصات الامتحانات الإلكترونية وحلول LMS الكاملة للجامعات.'],
                    ['q' => 'هل تستطيع الشركات الناشئة الطلابية في إربد تحمّل خدمات Alien Code؟', 'a' => 'نعم. لدينا مسار للشركات الناشئة بخطط سداد مرنة ونطاقات تركز على MVP مصممة خصيصاً للمشاريع المبكرة.'],
                    ['q' => 'هل تعملون مع المرافق الطبية في إربد؟', 'a' => 'نعم. نبني أنظمة إدارة العيادات والسجلات الطبية الإلكترونية (EMR) والمواعيد والفواتير لمقدمي الرعاية الصحية في إربد وشمال الأردن.'],
                ],
            ],
            'aqaba' => [
                'slug'       => 'aqaba',
                'name_en'    => 'Aqaba',
                'name_ar'    => 'العقبة',
                'region_en'  => 'Aqaba Governorate (Special Economic Zone)',
                'region_ar'  => 'محافظة العقبة (المنطقة الاقتصادية الخاصة)',
                'flag'       => '⚓',
                'lat'        => 29.5321,
                'lng'        => 35.0063,
                'pop_en'     => '200,000+',
                'pop_ar'     => 'أكثر من 200,000',
                'tagline_en' => 'Jordan\'s Gateway to the World — Digital Infrastructure for ASEZA',
                'tagline_ar' => 'بوابة الأردن إلى العالم — بنية رقمية لمنطقة العقبة الاقتصادية',
                'intro_en'   => 'Aqaba is Jordan\'s only seaport and home to the Aqaba Special Economic Zone Authority (ASEZA) — a business-friendly zone with tax incentives that attracts international investment in logistics, tourism, and trade. Aqaba businesses operate in a unique regulatory environment that demands software capable of handling port logistics, customs clearance, hotel management, and cross-border commerce. Alien Code brings enterprise-grade software expertise to Aqaba\'s growing economy.',
                'intro_ar'   => 'العقبة هي الميناء البحري الوحيد للأردن وموطن سلطة منطقة العقبة الاقتصادية الخاصة (أسيز) — منطقة صديقة للأعمال بحوافز ضريبية تجذب الاستثمار الدولي في اللوجستيات والسياحة والتجارة. تعمل شركات العقبة في بيئة تنظيمية فريدة تتطلب برمجيات قادرة على التعامل مع لوجستيات الموانئ وتخليص الجمارك وإدارة الفنادق والتجارة العابرة للحدود. تجلب Alien Code خبرة البرمجيات المؤسسية إلى اقتصاد العقبة المتنامي.',
                'sectors_en' => ['Port & Shipping Logistics', 'Hotels & Tourism', 'Duty-Free Retail', 'Export & Import Trading', 'Diving & Marine Tourism', 'ASEZA Registered Businesses'],
                'sectors_ar' => ['لوجستيات الموانئ والشحن', 'الفنادق والسياحة', 'تجارة الإعفاء الجمركي', 'تجارة التصدير والاستيراد', 'الغوص والسياحة البحرية', 'شركات أسيز المسجلة'],
                'why_en'     => [
                    '⚓ We build customs, freight, and port logistics systems compliant with ASEZA regulations.',
                    '🏨 Hotel PMS, booking engines, and guest management systems for Aqaba\'s hospitality sector.',
                    '🌍 Multi-currency, multi-language systems for Aqaba\'s international trading businesses.',
                ],
                'why_ar'     => [
                    '⚓ نبني أنظمة الجمارك والشحن ولوجستيات الموانئ المتوافقة مع أنظمة أسيز.',
                    '🏨 أنظمة إدارة الفنادق (PMS) ومحركات الحجز وإدارة الضيوف لقطاع الضيافة في العقبة.',
                    '🌍 أنظمة متعددة العملات والمتعددة اللغات لشركات التجارة الدولية في العقبة.',
                ],
                'faqs_en'    => [
                    ['q' => 'Do you build hotel management systems for Aqaba resorts?',  'a' => 'Yes. We build custom Hotel PMS, booking engines integrated with OTAs, housekeeping management, and guest loyalty programs for Aqaba\'s hospitality industry.'],
                    ['q' => 'Can you build ASEZA-compliant business software?',           'a' => 'Yes. We understand ASEZA\'s regulatory environment and build systems that accommodate its reporting, customs, and tax exemption requirements.'],
                    ['q' => 'Do you visit Aqaba for project requirements and demos?',    'a' => 'Yes. We conduct discovery sessions in Aqaba and can also deliver fully remote for teams comfortable with video meetings.'],
                ],
                'faqs_ar'    => [
                    ['q' => 'هل تبنون أنظمة إدارة الفنادق لمنتجعات العقبة؟', 'a' => 'نعم. نبني أنظمة إدارة فنادق (PMS) مخصصة ومحركات حجز متكاملة مع OTAs وإدارة التدبير المنزلي وبرامج ولاء الضيوف لقطاع الضيافة في العقبة.'],
                    ['q' => 'هل تستطيعون بناء برمجيات متوافقة مع أنظمة أسيز؟', 'a' => 'نعم. نفهم البيئة التنظيمية لأسيز ونبني أنظمة تستوعب متطلبات التقارير والجمارك والإعفاءات الضريبية الخاصة بها.'],
                    ['q' => 'هل تزورون العقبة لاستكشاف المتطلبات والعروض؟', 'a' => 'نعم. نعقد جلسات استكشاف في العقبة ويمكننا أيضاً التسليم عن بُعد بالكامل للفرق المرتاحة للاجتماعات بالفيديو.'],
                ],
            ],
        ];
    }

    public function show(string $citySlug)
    {
        $cities = $this->allCities();

        if (! array_key_exists($citySlug, $cities)) {
            abort(404);
        }

        $city     = $cities[$citySlug];
        $services = Service::active()->ordered()->get();

        return view('front.locations.show', compact('city', 'services'));
    }
}
