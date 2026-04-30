<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{HeroSection, Service, PortfolioItem, Client, Testimonial, Branch, Setting};

class AlienCodeSeeder extends Seeder
{
    public function run(): void
    {
        // ╔══════════════════════════════════════════════════════╗
        // ║  HERO SECTION                                        ║
        // ╚══════════════════════════════════════════════════════╝
        HeroSection::updateOrCreate(['id' => 1], [

            // ── Badge ───────────────────────────────────────────
            'badge_text_en'          => 'Operational · All systems online',
            'badge_text_ar'          => 'تشغيلي · جميع الأنظمة تعمل',

            // ── Title Lines ─────────────────────────────────────
            'title_line1_en'         => 'WE BUILD',
            'title_line1_ar'         => 'نحن نبني',
            'title_line2_en'         => 'DIGITAL WORLDS',
            'title_line2_ar'         => 'عوالم رقمية',
            'title_line3_en'         => 'FROM CODE',
            'title_line3_ar'         => 'من الكود',

            // ── Description ─────────────────────────────────────
            'description_en'         => 'Alien Code is a next-generation software development company. We architect high-performance applications, intelligent systems, and transformative digital experiences.',
            'description_ar'         => 'ألين كود شركة تطوير برمجيات من الجيل القادم. نبني تطبيقات عالية الأداء وأنظمة ذكية وتجارب رقمية استثنائية.',

            // ── CTA Buttons ─────────────────────────────────────
            'btn_primary_text_en'    => 'Explore Our Work',
            'btn_primary_text_ar'    => 'استكشف أعمالنا',
            'btn_primary_url'        => '#work',
            'btn_secondary_text_en'  => 'Start a Project',
            'btn_secondary_text_ar'  => 'ابدأ مشروعك',
            'btn_secondary_url'      => '#contact',

            // ── Stats ───────────────────────────────────────────
            'stat_projects'          => 150,
            'stat_years'             => 8,
            'stat_engineers'         => 50,
            'stat_satisfaction'      => 98,

            // ── SEO Meta ────────────────────────────────────────
            'meta_title_en'          => 'Alien Code — Next-Gen Software Development Company',
            'meta_title_ar'          => 'ألين كود — شركة تطوير برمجيات الجيل القادم',
            'meta_description_en'    => 'Alien Code builds high-performance web apps, mobile applications, AI systems, blockchain solutions and cloud infrastructure for startups and enterprises worldwide.',
            'meta_description_ar'    => 'ألين كود تبني تطبيقات ويب وجوال وأنظمة ذكاء اصطناعي وحلول بلوكتشين وبنية سحابية للشركات الناشئة والمؤسسات حول العالم.',
            'meta_keywords_en'       => 'software development company, web development, mobile app development, AI development, blockchain development, cloud infrastructure, DevOps, Jordan, Amman, Dubai, London',
            'meta_keywords_ar'       => 'شركة تطوير برمجيات, تطوير تطبيقات ويب, تطوير تطبيقات موبايل, ذكاء اصطناعي, بلوكتشين, بنية سحابية, ديف أوبس, الأردن, عمان, دبي',

            // ── OG / Social Share ────────────────────────────────
            'og_title_en'            => 'Alien Code — We Build Digital Worlds From Code',
            'og_title_ar'            => 'ألين كود — نبني عوالم رقمية من الكود',
            'og_description_en'      => '150+ projects delivered. 8 years of excellence. 50 expert engineers. Trusted by startups and Fortune 500s worldwide.',
            'og_description_ar'      => 'أكثر من ١٥٠ مشروع منجز. ٨ سنوات من التميز. ٥٠ مهندساً متخصصاً. موثوق به من الشركات الناشئة والشركات العالمية.',
            'og_image'               => null,

            // ── Schema.org ───────────────────────────────────────
            'schema_org_name'        => 'Alien Code',
            'schema_org_type'        => 'SoftwareCompany',
            'schema_org_url'         => 'https://alien-code.net',
            'schema_org_logo'        => null,

            // ── Canonical / Robots ───────────────────────────────
            'canonical_url_en'       => 'https://alien-code.net/en',
            'canonical_url_ar'       => 'https://alien-code.net/ar',
            'robots'                 => 'index, follow',

            'is_active'              => true,
        ]);

        // ╔══════════════════════════════════════════════════════╗
        // ║  SERVICES                                            ║
        // ╚══════════════════════════════════════════════════════╝
        $services = [
            [
                'icon'    => '🌐',
                'en'      => ['Web Development',
                              'Crafting pixel-perfect, blazing-fast web applications with cutting-edge frameworks that convert visitors into customers.'],
                'ar'      => ['تطوير الويب',
                              'بناء تطبيقات ويب سريعة ومتقنة بأحدث الأطر التقنية تحوّل الزوار إلى عملاء.'],
                'tags'    => ['React', 'Next.js', 'Vue', 'TypeScript', 'Laravel', 'Node.js'],
            ],
            [
                'icon'    => '📱',
                'en'      => ['Mobile Apps',
                              'Native and cross-platform mobile experiences that delight users on iOS and Android — from MVP to enterprise scale.'],
                'ar'      => ['تطبيقات الجوال',
                              'تطبيقات جوال متميزة تعمل على iOS وAndroid من المرحلة الأولى حتى المستوى المؤسسي.'],
                'tags'    => ['Flutter', 'Swift', 'Kotlin', 'React Native'],
            ],
            [
                'icon'    => '🤖',
                'en'      => ['AI & Machine Learning',
                              'Custom LLM integrations, computer vision, NLP, and predictive analytics that make your product smarter every day.'],
                'ar'      => ['الذكاء الاصطناعي',
                              'نماذج LLM مخصصة، رؤية حاسوبية، معالجة اللغة الطبيعية وتحليلات تنبؤية تجعل منتجك أكثر ذكاءً كل يوم.'],
                'tags'    => ['Python', 'TensorFlow', 'LLM', 'PyTorch', 'OpenAI'],
            ],
            [
                'icon'    => '☁️',
                'en'      => ['Cloud & DevOps',
                              'Scalable cloud infrastructure, automated CI/CD pipelines, Kubernetes orchestration, and zero-downtime deployments.'],
                'ar'      => ['السحابة والـ DevOps',
                              'بنية سحابية قابلة للتوسع مع أنابيب CI/CD آلية وتنسيق Kubernetes ونشر بلا توقف.'],
                'tags'    => ['AWS', 'GCP', 'Docker', 'Kubernetes', 'Terraform'],
            ],
            [
                'icon'    => '🔗',
                'en'      => ['Blockchain & Web3',
                              'Smart contracts, DeFi protocols, NFT platforms, and decentralized applications built on Ethereum and Solana.'],
                'ar'      => ['البلوكتشين وWeb3',
                              'عقود ذكية وبروتوكولات DeFi ومنصات NFT وتطبيقات لا مركزية على Ethereum وSolana.'],
                'tags'    => ['Solidity', 'Rust', 'Web3.js', 'IPFS', 'Hardhat'],
            ],
            [
                'icon'    => '🎨',
                'en'      => ['UI/UX Design',
                              'Human-centered design systems, interactive prototypes, and brand identities that leave lasting impressions.'],
                'ar'      => ['تصميم UI/UX',
                              'أنظمة تصميم محورها الإنسان ونماذج أولية تفاعلية وهويات بصرية مميزة تترك انطباعاً دائماً.'],
                'tags'    => ['Figma', 'Framer', 'Design System', 'Motion'],
            ],
        ];

        Service::truncate();
        foreach ($services as $i => $s) {
            Service::create([
                'icon'           => $s['icon'],
                'title_en'       => $s['en'][0],
                'title_ar'       => $s['ar'][0],
                'description_en' => $s['en'][1],
                'description_ar' => $s['ar'][1],
                'tags'           => $s['tags'],
                'sort_order'     => $i,
                'is_active'      => true,
            ]);
        }

        // ╔══════════════════════════════════════════════════════╗
        // ║  PORTFOLIO                                           ║
        // ╚══════════════════════════════════════════════════════╝
        $projects = [
            [
                'en'      => ['NovaTrade Platform', 'AI-powered trading dashboard with real-time analytics for 50K+ active traders.', 'FinTech'],
                'ar'      => ['منصة نوفاتريد', 'لوحة تداول مدعومة بالذكاء الاصطناعي لأكثر من ٥٠ ألف متداول نشط.', 'مالية'],
                'tags'    => ['FinTech', 'AI', 'React', 'Node.js'],
            ],
            [
                'en'      => ['HealthSync App', 'Mobile health tracking platform with 500K+ users across 30 countries.', 'HealthTech'],
                'ar'      => ['تطبيق هيلث سينك', 'منصة تتبع صحي بأكثر من نصف مليون مستخدم في ٣٠ دولة.', 'تقنية صحية'],
                'tags'    => ['Health', 'Flutter', 'Mobile', 'Firebase'],
            ],
            [
                'en'      => ['MetaVault NFT', 'Web3 NFT marketplace with $12M+ in completed transactions on Ethereum.', 'Blockchain'],
                'ar'      => ['ميتافولت NFT', 'سوق NFT على بلوكتشين بأكثر من ١٢ مليون دولار معاملات مكتملة.', 'بلوكتشين'],
                'tags'    => ['Web3', 'NFT', 'Solidity', 'IPFS'],
            ],
            [
                'en'      => ['AdminCore CMS', 'Enterprise content management system serving 10M daily API requests.', 'Enterprise'],
                'ar'      => ['منصة أدمن كور', 'نظام إدارة محتوى مؤسسي يخدم ١٠ ملايين طلب API يومياً.', 'مؤسسي'],
                'tags'    => ['Enterprise', 'Node.js', 'AWS', 'PostgreSQL'],
            ],
            [
                'en'      => ['SocialCircle', 'Community-first social platform that hit 200K downloads in its first month.', 'Social'],
                'ar'      => ['سوشيال سيركل', 'منصة اجتماعية مجتمعية وصلت إلى ٢٠٠ ألف تحميل في شهرها الأول.', 'اجتماعي'],
                'tags'    => ['Social', 'iOS', 'Android', 'React Native'],
            ],
            [
                'en'      => ['MarketPulse AI', 'Predictive market intelligence system built for hedge funds and institutional traders.', 'AI/ML'],
                'ar'      => ['ماركت بولس AI', 'نظام استخبارات تنبؤية للأسواق لصناديق التحوط والمتداولين المؤسسيين.', 'ذكاء اصطناعي'],
                'tags'    => ['AI', 'Python', 'TensorFlow', 'FastAPI'],
            ],
        ];

        PortfolioItem::truncate();
        foreach ($projects as $i => $p) {
            PortfolioItem::create([
                'title_en'       => $p['en'][0],
                'title_ar'       => $p['ar'][0],
                'description_en' => $p['en'][1],
                'description_ar' => $p['ar'][1],
                'category_en'    => $p['en'][2],
                'category_ar'    => $p['ar'][2],
                'tags'           => $p['tags'],
                'sort_order'     => $i,
                'is_active'      => true,
            ]);
        }

        // ╔══════════════════════════════════════════════════════╗
        // ║  CLIENTS                                             ║
        // ╚══════════════════════════════════════════════════════╝
        $clientNames = [
            'NEXACORE', 'VERIDIAN', 'ORBITEX', 'SYNTHWAVE',
            'QUANTUMLY', 'HYPERION', 'AXIOFLOW', 'PRISMTECH',
        ];
        Client::truncate();
        foreach ($clientNames as $i => $name) {
            Client::create(['name' => $name, 'sort_order' => $i, 'is_active' => true]);
        }

        // ╔══════════════════════════════════════════════════════╗
        // ║  TESTIMONIALS                                        ║
        // ╚══════════════════════════════════════════════════════╝
        $testimonials = [
            [
                'name_en'    => 'James Rodriguez',    'name_ar'    => 'جيمس رودريغيز',
                'role_en'    => 'CTO',                'role_ar'    => 'المدير التقني',
                'company'    => 'NovaTrade Inc.',
                'quote_en'   => 'Alien Code transformed our legacy system into a blazing-fast platform. Their team understood our vision immediately and delivered beyond expectations. Truly alien-level talent.',
                'quote_ar'   => 'حوّل ألين كود نظامنا القديم إلى منصة بسرعة خارقة. فهم فريقهم رؤيتنا فوراً وسلّموا ما يتجاوز التوقعات. موهبة من مستوى آخر حقاً.',
                'rating'     => 5,
            ],
            [
                'name_en'    => 'Sarah Kim',          'name_ar'    => 'سارة كيم',
                'role_en'    => 'CEO',                'role_ar'    => 'الرئيس التنفيذي',
                'company'    => 'HealthSync Global',
                'quote_en'   => 'The AI integration they built increased our conversion by 340%. They are not just coders — they are strategic partners who deeply understand business outcomes.',
                'quote_ar'   => 'رفع تكامل الذكاء الاصطناعي الذي بنوه معدل تحويلنا بنسبة ٣٤٠٪. هم ليسوا مجرد مبرمجين — إنهم شركاء استراتيجيون يفهمون نتائج الأعمال بعمق.',
                'rating'     => 5,
            ],
            [
                'name_en'    => 'Alex Müller',        'name_ar'    => 'أليكس مولر',
                'role_en'    => 'Founder',            'role_ar'    => 'المؤسس',
                'company'    => 'MetaVault',
                'quote_en'   => 'Alien Code shipped our blockchain protocol two weeks ahead of schedule with zero critical bugs. Quality bar is genuinely alien-level compared to other agencies.',
                'quote_ar'   => 'سلّم ألين كود بروتوكول البلوكتشين قبل الموعد بأسبوعين دون أي أخطاء حرجة. معيار الجودة لديهم استثنائي مقارنةً بأي وكالة أخرى.',
                'rating'     => 5,
            ],
            [
                'name_en'    => 'Laura Patel',        'name_ar'    => 'لورا باتيل',
                'role_en'    => 'VP Engineering',     'role_ar'    => 'نائب رئيس الهندسة',
                'company'    => 'Quantumly',
                'quote_en'   => 'Their DevOps expertise saved us $180K annually. The Kubernetes migration was seamless and their documentation is impeccable. Highly recommended.',
                'quote_ar'   => 'وفّرت خبرتهم في DevOps لنا ١٨٠ ألف دولار سنوياً. كانت عملية نقل Kubernetes سلسة تماماً وتوثيقهم منقطع النظير. أنصح بهم بشدة.',
                'rating'     => 5,
            ],
            [
                'name_en'    => 'Tom Nakamura',       'name_ar'    => 'توم ناكامورا',
                'role_en'    => 'Product Lead',       'role_ar'    => 'قائد المنتج',
                'company'    => 'Synthwave',
                'quote_en'   => 'Outstanding UI/UX work. They redesigned our entire product and user engagement went up 220%. The animations and interactions feel like actual magic.',
                'quote_ar'   => 'عمل UI/UX استثنائي. أعادوا تصميم منتجنا بالكامل وارتفع تفاعل المستخدمين بنسبة ٢٢٠٪. الرسوم المتحركة والتفاعلات تبدو كالسحر.',
                'rating'     => 5,
            ],
            [
                'name_en'    => 'Elena Becker',       'name_ar'    => 'إيلينا بيكر',
                'role_en'    => 'CMO',                'role_ar'    => 'مدير التسويق',
                'company'    => 'SocialCircle',
                'quote_en'   => 'From the first call to final delivery, Alien Code was transparent and proactive. Our mobile app hit 200K downloads in the first month. Extraordinary team.',
                'quote_ar'   => 'من أول مكالمة حتى التسليم النهائي، كان ألين كود شفافاً واستباقياً. وصل تطبيقنا إلى ٢٠٠ ألف تحميل في الشهر الأول. فريق استثنائي.',
                'rating'     => 5,
            ],
        ];

        Testimonial::truncate();
        foreach ($testimonials as $i => $t) {
            Testimonial::create([
                'author_name_en' => $t['name_en'],
                'author_name_ar' => $t['name_ar'],
                'author_role_en' => $t['role_en'],
                'author_role_ar' => $t['role_ar'],
                'author_company' => $t['company'],
                'quote_en'       => $t['quote_en'],
                'quote_ar'       => $t['quote_ar'],
                'rating'         => $t['rating'],
                'sort_order'     => $i,
                'is_active'      => true,
            ]);
        }

        // ╔══════════════════════════════════════════════════════╗
        // ║  BRANCHES                                            ║
        // ╚══════════════════════════════════════════════════════╝
        $branches = [
            [
                'flag'    => '🇯🇴',
                'city'    => ['Amman',        'عمّان'],
                'country' => ['Jordan',       'الأردن'],
                'label'   => ['HQ',           'المقر الرئيسي'],
                'address' => ['King Abdullah II St, Amman 11183', 'شارع الملك عبدالله الثاني، عمّان ١١١٨٣'],
                'phone'   => '+962 6 500 0000',
                'email'   => 'hello@alien-code.net',
                'hours'   => ['Sun–Thu: 9am–6pm AST',  'الأحد–الخميس: ٩ص–٦م'],
                'lat'     => 31.9539, 'lng' => 35.9106,
            ],
            [
                'flag'    => '🇦🇪',
                'city'    => ['Dubai',         'دبي'],
                'country' => ['UAE',           'الإمارات'],
                'label'   => ['Regional',      'إقليمي'],
                'address' => ['DIFC Gate Avenue, Level 2, Dubai', 'بوابة أفنيو DIFC، الطابق الثاني، دبي'],
                'phone'   => '+971 4 000 0000',
                'email'   => 'dubai@alien-code.net',
                'hours'   => ['Mon–Fri: 9am–6pm GST',  'الإثنين–الجمعة: ٩ص–٦م'],
                'lat'     => 25.2048, 'lng' => 55.2708,
            ],
            [
                'flag'    => '🇬🇧',
                'city'    => ['London',        'لندن'],
                'country' => ['United Kingdom','المملكة المتحدة'],
                'label'   => ['Europe',        'أوروبا'],
                'address' => ['Canary Wharf, Level 18, London E14', 'كاناري وارف، الطابق ١٨، لندن E14'],
                'phone'   => '+44 20 0000 0000',
                'email'   => 'london@alien-code.net',
                'hours'   => ['Mon–Fri: 9am–6pm GMT',  'الإثنين–الجمعة: ٩ص–٦م'],
                'lat'     => 51.5045, 'lng' => -0.0865,
            ],
            [
                'flag'    => '🇺🇸',
                'city'    => ['New York',      'نيويورك'],
                'country' => ['USA',           'الولايات المتحدة'],
                'label'   => ['Americas',      'الأمريكتين'],
                'address' => ['One World Trade Center, New York 10007', 'برج واحد وورلد تريد، نيويورك ١٠٠٠٧'],
                'phone'   => '+1 212 000 0000',
                'email'   => 'nyc@alien-code.net',
                'hours'   => ['Mon–Fri: 9am–6pm EST',  'الإثنين–الجمعة: ٩ص–٦م'],
                'lat'     => 40.7127, 'lng' => -74.0134,
            ],
        ];

        Branch::truncate();
        foreach ($branches as $i => $b) {
            Branch::create([
                'flag_emoji'       => $b['flag'],
                'city_en'          => $b['city'][0],    'city_ar'          => $b['city'][1],
                'country_en'       => $b['country'][0], 'country_ar'       => $b['country'][1],
                'label_en'         => $b['label'][0],   'label_ar'         => $b['label'][1],
                'address_en'       => $b['address'][0], 'address_ar'       => $b['address'][1],
                'phone'            => $b['phone'],
                'email'            => $b['email'],
                'working_hours_en' => $b['hours'][0],   'working_hours_ar' => $b['hours'][1],
                'latitude'         => $b['lat'],         'longitude'        => $b['lng'],
                'sort_order'       => $i,
                'is_active'        => true,
            ]);
        }

        // ╔══════════════════════════════════════════════════════╗
        // ║  SETTINGS — full SEO set                             ║
        // ╚══════════════════════════════════════════════════════╝
        $settings = [
            // ── General ────────────────────────────────────────
            ['site_name_en',        'Alien Code',                                          'general', 'text',     'Site Name (EN)',           'اسم الموقع (EN)'],
            ['site_name_ar',        'ألين كود',                                             'general', 'text',     'Site Name (AR)',           'اسم الموقع (AR)'],
            ['about_title_en',      "We Don't Write Code. We Write the Future.",           'general', 'text',     'About Title (EN)',         'عنوان من نحن (EN)'],
            ['about_title_ar',      'لا نكتب كوداً. نكتب المستقبل.',                        'general', 'text',     'About Title (AR)',         'عنوان من نحن (AR)'],
            ['about_desc_en',       'Born in Amman, operating globally. Alien Code is a team of expert engineers obsessed with turning impossible ideas into production-grade realities since 2016.', 'general', 'textarea', 'About Desc (EN)', 'وصف من نحن (EN)'],
            ['about_desc_ar',       'نشأنا في عمّان ونعمل عالمياً. ألين كود فريق من المهندسين المتخصصين المهووسين بتحويل الأفكار المستحيلة إلى واقع برمجي منذ ٢٠١٦.',  'general', 'textarea', 'About Desc (AR)', 'وصف من نحن (AR)'],

            // ── SEO ────────────────────────────────────────────
            ['meta_title_en',       'Alien Code — Next-Gen Software Development Company',  'seo', 'text',     'Meta Title (EN)',          'عنوان Meta (EN)'],
            ['meta_title_ar',       'ألين كود — شركة تطوير برمجيات الجيل القادم',          'seo', 'text',     'Meta Title (AR)',          'عنوان Meta (AR)'],
            ['meta_desc_en',        'Alien Code builds high-performance web apps, mobile apps, AI systems, blockchain solutions and cloud infrastructure for startups and enterprises worldwide.', 'seo', 'textarea', 'Meta Desc (EN)', 'وصف Meta (EN)'],
            ['meta_desc_ar',        'ألين كود تبني تطبيقات ويب وجوال وأنظمة ذكاء اصطناعي وحلول بلوكتشين وبنية سحابية للشركات الناشئة والمؤسسات حول العالم.',            'seo', 'textarea', 'Meta Desc (AR)', 'وصف Meta (AR)'],
            ['meta_keywords_en',    'software development, web development, mobile app, AI, blockchain, cloud, DevOps, Amman, Jordan, Dubai', 'seo', 'text', 'Keywords (EN)', 'الكلمات المفتاحية (EN)'],
            ['meta_keywords_ar',    'تطوير برمجيات, تطوير ويب, تطبيق موبايل, ذكاء اصطناعي, بلوكتشين, سحابة, ديف أوبس, الأردن, عمان, دبي',                               'seo', 'text', 'Keywords (AR)', 'الكلمات المفتاحية (AR)'],
            ['og_image',            '',                                                    'seo', 'image',    'OG Share Image',          'صورة المشاركة'],
            ['twitter_site',        '@aliencode',                                          'seo', 'text',     'Twitter Handle',          'حساب تويتر'],
            ['google_site_verify',  '',                                                    'seo', 'text',     'Google Verification',     'كود التحقق من Google'],
            ['canonical_url',       'https://alien-code.net',                              'seo', 'text',     'Canonical URL',           'الرابط الأساسي'],
            ['robots',              'index, follow',                                       'seo', 'text',     'Robots',                  'Robots'],

            // ── Contact ────────────────────────────────────────
            ['contact_email',       'hello@alien-code.net',                                'contact', 'text',  'Contact Email',           'البريد الإلكتروني'],
            ['contact_phone',       '+962 6 500 0000',                                    'contact', 'text',  'Phone',                   'الهاتف'],
            ['whatsapp',            '962600000000',                                       'contact', 'text',  'WhatsApp',                'واتساب'],

            // ── Social ─────────────────────────────────────────
            ['linkedin',            'https://linkedin.com/company/alien-code',            'social', 'text',   'LinkedIn',                'لينكدإن'],
            ['twitter',             'https://twitter.com/aliencode',                      'social', 'text',   'Twitter / X',             'تويتر / X'],
            ['github',              'https://github.com/alien-code',                      'social', 'text',   'GitHub',                  'جيت هاب'],
            ['instagram',           'https://instagram.com/aliencode',                    'social', 'text',   'Instagram',               'انستقرام'],
            ['dribbble',            '',                                                    'social', 'text',   'Dribbble',                'دريبل'],

            // ── Analytics ──────────────────────────────────────
            ['ga_id',               '',                                                    'analytics', 'text', 'Google Analytics ID',    'معرف Google Analytics'],
            ['gtm_id',              '',                                                    'analytics', 'text', 'Google Tag Manager ID',  'معرف Google Tag Manager'],
            ['hotjar_id',           '',                                                    'analytics', 'text', 'Hotjar Site ID',         'معرف Hotjar'],
        ];

        Setting::truncate();
        foreach ($settings as [$key, $value, $group, $type, $labelEn, $labelAr]) {
            Setting::create([
                'key'      => $key,
                'value'    => $value,
                'group'    => $group,
                'type'     => $type,
                'label_en' => $labelEn,
                'label_ar' => $labelAr,
            ]);
        }

        $this->command->info('');
        $this->command->info('✅  Alien Code seeder complete!');
        $this->command->info('   → Hero section seeded with full SEO fields');
        $this->command->info('   → ' . Service::count()      . ' services');
        $this->command->info('   → ' . PortfolioItem::count(). ' portfolio items');
        $this->command->info('   → ' . Client::count()       . ' clients');
        $this->command->info('   → ' . Testimonial::count()  . ' testimonials');
        $this->command->info('   → ' . Branch::count()       . ' branches');
        $this->command->info('   → ' . Setting::count()      . ' settings');
        $this->command->info('');
    }
}