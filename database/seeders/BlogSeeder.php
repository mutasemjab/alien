<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [

            // =====================================================
            // POST 1 — Laravel Development Jordan
            // =====================================================
            [
                'slug'          => 'laravel-development-jordan-why-alien-code-leads',
                'title_en'      => 'Laravel Development in Jordan: Why Alien Code Leads the Market',
                'title_ar'      => 'تطوير لارافيل في الأردن: لماذا يتصدر كود أليين السوق',
                'excerpt_en'    => 'Discover why Alien Code is Jordan\'s premier Laravel development partner — delivering scalable, secure, and high-performance web applications for businesses across the region.',
                'excerpt_ar'    => 'اكتشف لماذا يُعدّ كود أليين الشريك الأول في الأردن لتطوير لارافيل، إذ يقدم تطبيقات ويب قابلة للتوسع وآمنة وعالية الأداء للشركات في المنطقة.',
                'body_en'       => <<<HTML
<h2>The Laravel Ecosystem in Jordan's Tech Scene</h2>
<p>Jordan has quietly become one of the Middle East's most dynamic technology hubs, and at the center of its web development revolution is <strong>Laravel</strong> — the PHP framework loved by developers worldwide for its elegant syntax and powerful features. At <strong>Alien Code</strong>, we have built our engineering culture around Laravel since day one, making us the go-to partner for businesses that demand reliable, enterprise-grade web solutions in Amman and beyond.</p>

<h2>Why Laravel? Why Now?</h2>
<p>Laravel powers millions of applications globally — from SaaS platforms and e-commerce giants to government portals and fintech systems. Its built-in tools for authentication, routing, queuing, caching, and database management let our teams ship production-ready features at a pace that would be impossible with lower-level frameworks.</p>
<ul>
  <li><strong>Eloquent ORM</strong> — intuitive database interactions without raw SQL complexity</li>
  <li><strong>Artisan CLI</strong> — automation at every stage of development</li>
  <li><strong>Laravel Horizon & Queues</strong> — background processing that scales</li>
  <li><strong>Sanctum & Passport</strong> — modern API authentication out of the box</li>
  <li><strong>Livewire & Inertia.js</strong> — reactive UIs without the overhead of a full SPA</li>
</ul>

<h2>What Alien Code Builds with Laravel</h2>
<p>Our team in Amman has delivered Laravel solutions across verticals including healthcare, real estate, logistics, e-commerce, and education. Whether you need a multi-tenant SaaS platform, a RESTful API consumed by mobile apps, or a high-traffic public-facing portal, our engineers architect it for performance and long-term maintainability.</p>

<h2>Our Laravel Development Process</h2>
<p>We follow a proven agile methodology:</p>
<ol>
  <li><strong>Discovery &amp; Architecture</strong> — we map your business logic before writing a single line of code</li>
  <li><strong>Sprint-based Development</strong> — two-week cycles with continuous delivery and client demos</li>
  <li><strong>Code Review &amp; Testing</strong> — PHPUnit and Pest test suites, static analysis with PHPStan</li>
  <li><strong>CI/CD Pipeline</strong> — automated deployments to staging and production on every merge</li>
  <li><strong>Post-launch Support</strong> — monitoring, performance tuning, and iterative improvements</li>
</ol>

<h2>Laravel + the Jordanian Market</h2>
<p>Arabic-language support, right-to-left (RTL) layouts, local payment gateway integrations (eFAWATEERcom, PayFort, Hyperpay), and compliance with Jordanian data regulations are not afterthoughts for us — they are first-class requirements built into every project from the start.</p>

<h2>Ready to Build?</h2>
<p>If you are looking for a <strong>Laravel development company in Jordan</strong> that combines global engineering standards with deep regional expertise, Alien Code is your answer. <a href="/contact">Contact our team today</a> for a free technical consultation.</p>
HTML,
                'body_ar'       => <<<HTML
<h2>منظومة لارافيل في المشهد التقني الأردني</h2>
<p>أصبح الأردن بهدوء أحد أكثر المراكز التكنولوجية ديناميكية في الشرق الأوسط، وفي قلب ثورة تطوير الويب فيه يقع <strong>لارافيل</strong> — إطار PHP الذي يحبه المطورون حول العالم لتركيبه الأنيق وميزاته القوية. في <strong>كود أليين</strong>، بنينا ثقافتنا الهندسية حول لارافيل منذ اليوم الأول، مما جعلنا الشريك المفضل للشركات التي تحتاج إلى حلول ويب موثوقة بمستوى المؤسسات في عمّان وما وراءها.</p>

<h2>لماذا لارافيل؟</h2>
<p>يشغّل لارافيل ملايين التطبيقات عالمياً — من منصات SaaS وعمالقة التجارة الإلكترونية إلى بوابات حكومية وأنظمة فينتك. أدواته المدمجة للمصادقة والتوجيه ومعالجة الطوابير والتخزين المؤقت وإدارة قواعد البيانات تتيح لفرقنا شحن ميزات جاهزة للإنتاج بوتيرة يصعب تحقيقها مع أطر العمل الأدنى مستوى.</p>

<h2>ما الذي يبنيه كود أليين بلارافيل؟</h2>
<p>قدّم فريقنا في عمّان حلول لارافيل في قطاعات متعددة تشمل الرعاية الصحية والعقارات والخدمات اللوجستية والتجارة الإلكترونية والتعليم. سواء كنت تحتاج إلى منصة SaaS متعددة المستأجرين، أو واجهة برمجية RESTful تستهلكها تطبيقات الجوال، أو بوابة عامة عالية الحركة، فإن مهندسينا يصممونها بحيث تكون عالية الأداء وسهلة الصيانة على المدى البعيد.</p>

<h2>هل أنت مستعد للبناء؟</h2>
<p>إذا كنت تبحث عن <strong>شركة تطوير لارافيل في الأردن</strong> تجمع بين معايير الهندسة العالمية والخبرة الإقليمية العميقة، فإن كود أليين هو الجواب. <a href="/contact">تواصل مع فريقنا اليوم</a> للحصول على استشارة تقنية مجانية.</p>
HTML,
                'image'         => 'blogs/laravel-development-jordan.jpg',
                'category_en'   => 'Web Development',
                'category_ar'   => 'تطوير الويب',
                'tags'          => json_encode(['Laravel', 'PHP', 'Jordan', 'Web Development', 'Amman']),
                'author'        => 'Alien Code Team',
                'meta_title_en' => 'Laravel Development Jordan | Alien Code — Expert PHP Engineers in Amman',
                'meta_title_ar' => 'تطوير لارافيل في الأردن | كود أليين — مهندسو PHP خبراء في عمّان',
                'meta_desc_en'  => 'Alien Code is Jordan\'s leading Laravel development company. We build scalable PHP web applications for businesses in Amman and across the Middle East. Get a free consultation.',
                'meta_desc_ar'  => 'كود أليين هي شركة تطوير لارافيل الرائدة في الأردن. نبني تطبيقات ويب PHP قابلة للتوسع للشركات في عمّان وفي جميع أنحاء الشرق الأوسط.',
                'is_active'     => true,
                'published_at'  => Carbon::now()->subDays(14),
                'sort_order'    => 1,
            ],

            // =====================================================
            // POST 2 — AI Software Company Amman
            // =====================================================
            [
                'slug'          => 'ai-software-company-amman-alien-code',
                'title_en'      => 'Alien Code: Amman\'s Leading AI Software Company',
                'title_ar'      => 'كود أليين: شركة الذكاء الاصطناعي الرائدة في عمّان',
                'excerpt_en'    => 'Explore how Alien Code is pioneering artificial intelligence solutions from Amman — from NLP and computer vision to predictive analytics and intelligent automation.',
                'excerpt_ar'    => 'اكتشف كيف يرسم كود أليين مستقبل الذكاء الاصطناعي من عمّان، من معالجة اللغة الطبيعية ورؤية الحاسوب إلى التحليلات التنبؤية والأتمتة الذكية.',
                'body_en'       => <<<HTML
<h2>Artificial Intelligence, Built in Amman for the World</h2>
<p><strong>Alien Code</strong> is not just a software company — we are a strategic AI partner helping businesses across Jordan, the Gulf, and beyond harness machine intelligence to solve real operational problems. Our AI division in Amman combines deep academic knowledge with hands-on engineering to deliver production-ready AI systems, not just prototypes.</p>

<h2>Our AI Service Portfolio</h2>
<h3>Natural Language Processing (NLP)</h3>
<p>We build Arabic-first NLP pipelines — sentiment analysis, named entity recognition, text classification, and conversational AI chatbots trained on regional dialect data. For Jordanian and MENA businesses, this matters enormously.</p>

<h3>Computer Vision</h3>
<p>From document digitization and OCR for Arabic text to real-time object detection for logistics and retail, our computer vision team uses PyTorch and TensorFlow to ship models that run efficiently on both cloud and edge hardware.</p>

<h3>Predictive Analytics & Machine Learning</h3>
<p>We integrate ML pipelines directly into your existing business systems — CRM, ERP, e-commerce platforms — giving your team actionable predictions on demand forecasting, churn prevention, fraud detection, and more.</p>

<h3>Intelligent Automation (AI + RPA)</h3>
<p>Combining large language models (LLMs) with robotic process automation, we automate complex, judgment-intensive workflows that traditional rule-based automation cannot handle.</p>

<h2>Why Choose an AI Company Based in Jordan?</h2>
<p>Working with a local AI partner means faster iteration cycles, time-zone-aligned collaboration, deep understanding of Arabic language requirements, and compliance knowledge for regional data regulations. Alien Code offers all of this alongside an engineering team that holds its own against any global competitor.</p>

<h2>Our AI Tech Stack</h2>
<ul>
  <li>Python, FastAPI, LangChain, LlamaIndex</li>
  <li>OpenAI, Anthropic Claude, and open-source LLMs (Mistral, LLaMA)</li>
  <li>PyTorch, TensorFlow, Hugging Face Transformers</li>
  <li>MLflow, Weights &amp; Biases for experiment tracking</li>
  <li>Vector databases: Pinecone, Weaviate, pgvector</li>
</ul>

<h2>Case Study Highlight</h2>
<p>We recently delivered an AI-powered document processing system for a leading Jordanian financial services company — cutting manual review time by 73% and improving classification accuracy to 96.4% on Arabic-language forms.</p>

<h2>Let's Build Intelligent Systems Together</h2>
<p>If you are looking for an <strong>AI software company in Amman</strong> with proven results, <a href="/contact">reach out to Alien Code</a>. We offer discovery workshops to identify the highest-impact AI opportunities in your business.</p>
HTML,
                'body_ar'       => <<<HTML
<h2>الذكاء الاصطناعي، مبني في عمّان للعالم</h2>
<p><strong>كود أليين</strong> ليست مجرد شركة برمجيات — نحن شريك ذكاء اصطناعي استراتيجي يساعد الشركات في الأردن والخليج وما وراءهما على الاستفادة من الذكاء الآلي لحل مشكلات تشغيلية حقيقية. يجمع قسم الذكاء الاصطناعي لدينا في عمّان بين المعرفة الأكاديمية العميقة والهندسة العملية لتسليم أنظمة ذكاء اصطناعي جاهزة للإنتاج، وليس مجرد نماذج أولية.</p>

<h2>محفظة خدمات الذكاء الاصطناعي لدينا</h2>
<h3>معالجة اللغة الطبيعية</h3>
<p>نبني خطوط معالجة لغة طبيعية تضع العربية في المقدمة — تحليل المشاعر، والتعرف على الكيانات المسماة، وتصنيف النصوص، وروبوتات المحادثة المدربة على بيانات اللهجات الإقليمية.</p>

<h3>رؤية الحاسوب</h3>
<p>من رقمنة المستندات والتعرف الضوئي على الحروف للنصوص العربية إلى الكشف عن الأشياء في الوقت الفعلي للوجستيات والتجزئة، يستخدم فريق رؤية الحاسوب لدينا PyTorch وTensorFlow لشحن نماذج تعمل بكفاءة على السحابة والحواف.</p>

<h2>هل أنت مستعد لبناء أنظمة ذكية؟</h2>
<p>إذا كنت تبحث عن <strong>شركة ذكاء اصطناعي في عمّان</strong> بنتائج موثّقة، <a href="/contact">تواصل مع كود أليين</a>. نقدم ورش اكتشاف لتحديد أعلى فرص الذكاء الاصطناعي تأثيراً في عملك.</p>
HTML,
                'image'         => 'blogs/ai-software-company-amman.jpg',
                'category_en'   => 'Artificial Intelligence',
                'category_ar'   => 'الذكاء الاصطناعي',
                'tags'          => json_encode(['AI', 'Machine Learning', 'NLP', 'Amman', 'Jordan', 'Deep Learning']),
                'author'        => 'Alien Code Team',
                'meta_title_en' => 'AI Software Company Amman | Alien Code — Machine Learning & NLP Solutions',
                'meta_title_ar' => 'شركة ذكاء اصطناعي في عمّان | كود أليين — حلول تعلم الآلة ومعالجة اللغة',
                'meta_desc_en'  => 'Alien Code is Amman\'s leading AI software company. We build NLP, computer vision, and machine learning solutions for businesses in Jordan and the MENA region.',
                'meta_desc_ar'  => 'كود أليين هي شركة الذكاء الاصطناعي الرائدة في عمّان. نبني حلول معالجة اللغة الطبيعية ورؤية الحاسوب وتعلم الآلة للشركات في الأردن ومنطقة الشرق الأوسط.',
                'is_active'     => true,
                'published_at'  => Carbon::now()->subDays(11),
                'sort_order'    => 2,
            ],

            // =====================================================
            // POST 3 — Custom Mobile App Development
            // =====================================================
            [
                'slug'          => 'custom-mobile-app-development-jordan',
                'title_en'      => 'Custom Mobile App Development in Jordan: From Idea to App Store',
                'title_ar'      => 'تطوير تطبيقات الجوال المخصصة في الأردن: من الفكرة إلى متجر التطبيقات',
                'excerpt_en'    => 'Alien Code delivers end-to-end custom mobile app development for iOS and Android — combining beautiful UX design with robust backend engineering to launch apps that users love.',
                'excerpt_ar'    => 'يقدم كود أليين تطوير تطبيقات جوال مخصصة شاملاً لـ iOS وAndroid — يجمع بين تصميم UX جميل وهندسة خلفية متينة لإطلاق تطبيقات يحبها المستخدمون.',
                'body_en'       => <<<HTML
<h2>Your Vision, Our Code, Your Users' Hands</h2>
<p>In 2025, mobile is not just a channel — it is the primary interface between businesses and their customers. <strong>Alien Code</strong> has developed dozens of custom mobile applications for clients across Jordan, Saudi Arabia, UAE, and beyond. Whether you need a consumer app, an enterprise mobility solution, or a complex marketplace, our mobile team delivers it with precision.</p>

<h2>Native vs. Cross-Platform: What's Right for You?</h2>
<h3>React Native</h3>
<p>Our preferred cross-platform framework for most projects. A single JavaScript codebase delivers near-native performance on both iOS and Android, cutting development time and cost significantly while maintaining a high-quality user experience.</p>

<h3>Flutter</h3>
<p>When pixel-perfect UI fidelity is critical and you need a single codebase that also targets web and desktop, Flutter is our recommendation. Dart's performance characteristics make it excellent for animation-heavy and real-time applications.</p>

<h3>Native iOS (Swift) & Android (Kotlin)</h3>
<p>For applications that require maximum performance, deep hardware access (ARKit, Bluetooth LE, NFC), or platform-specific integrations, we build fully native apps with Swift and Kotlin.</p>

<h2>Our Mobile App Development Process</h2>
<ol>
  <li><strong>Strategy &amp; Discovery</strong> — user research, competitive analysis, feature prioritization</li>
  <li><strong>UX/UI Design</strong> — wireframes, interactive prototypes, design system creation</li>
  <li><strong>Backend API Development</strong> — RESTful or GraphQL APIs, typically built with Laravel</li>
  <li><strong>Mobile Development</strong> — sprint-based build cycles with weekly demos</li>
  <li><strong>QA &amp; Testing</strong> — automated UI tests, device farm testing, performance profiling</li>
  <li><strong>App Store Submission</strong> — we handle the full review process for Apple App Store and Google Play</li>
  <li><strong>Post-Launch Growth</strong> — analytics integration, A/B testing, iterative feature releases</li>
</ol>

<h2>Industries We Serve</h2>
<ul>
  <li>🛒 <strong>E-commerce &amp; Retail</strong> — Arabic-first shopping experiences with local payment gateways</li>
  <li>🏥 <strong>Healthcare &amp; Telemedicine</strong> — HIPAA-aware patient and provider apps</li>
  <li>🚗 <strong>On-Demand &amp; Delivery</strong> — real-time tracking, driver dispatch, order management</li>
  <li>🏢 <strong>Enterprise &amp; Field Service</strong> — offline-capable B2B apps for field teams</li>
  <li>📚 <strong>EdTech</strong> — interactive learning platforms with video streaming and assessments</li>
  <li>🏦 <strong>Fintech</strong> — secure payment, wallet, and investment apps</li>
</ul>

<h2>Why Alien Code for Mobile Development?</h2>
<p>We are not a body-shop — we are a product engineering partner. Our in-house UI/UX designers, backend engineers, and mobile developers collaborate in one team, eliminating the coordination overhead that slows down outsourced projects. Every app we ship is backed by a full quality assurance process and supported by our post-launch engineering team.</p>

<h2>Start Your Mobile App Project</h2>
<p>Ready to build a <strong>custom mobile app in Jordan</strong> that stands out in the App Store? <a href="/contact">Book a free discovery call</a> with Alien Code and let's turn your idea into a product your users will love.</p>
HTML,
                'body_ar'       => <<<HTML
<h2>رؤيتك، كودنا، أيدي مستخدميك</h2>
<p>في عام 2025، الجوال ليس مجرد قناة — إنه الواجهة الأساسية بين الشركات وعملائها. طوّر <strong>كود أليين</strong> عشرات التطبيقات الجوالة المخصصة لعملاء في الأردن والسعودية والإمارات وما وراءها. سواء كنت تحتاج إلى تطبيق للمستهلكين، أو حل تنقل للمؤسسات، أو سوق إلكترونية معقدة، فإن فريق الجوال لدينا يسلمه بدقة.</p>

<h2>عملية تطوير تطبيقات الجوال لدينا</h2>
<ol>
  <li><strong>الاستراتيجية والاكتشاف</strong> — بحث المستخدمين، وتحليل المنافسين، وترتيب أولويات الميزات</li>
  <li><strong>تصميم UX/UI</strong> — إطارات سلكية، ونماذج أولية تفاعلية، وإنشاء نظام تصميم</li>
  <li><strong>تطوير API الخلفي</strong> — واجهات برمجية RESTful أو GraphQL، مبنية عادةً بلارافيل</li>
  <li><strong>التطوير الجوال</strong> — دورات بناء قائمة على السباقات مع عروض أسبوعية</li>
  <li><strong>ضمان الجودة والاختبار</strong> — اختبارات UI آلية، واختبار مزرعة الأجهزة، وتحليل الأداء</li>
  <li><strong>إرسال متجر التطبيقات</strong> — نتولى عملية المراجعة الكاملة لـ Apple App Store وGoogle Play</li>
</ol>

<h2>ابدأ مشروع تطبيقك الجوال</h2>
<p>هل أنت مستعد لبناء <strong>تطبيق جوال مخصص في الأردن</strong>؟ <a href="/contact">احجز مكالمة اكتشاف مجانية</a> مع كود أليين ودعنا نحوّل فكرتك إلى منتج يحبه مستخدموك.</p>
HTML,
                'image'         => 'blogs/custom-mobile-app-development.jpg',
                'category_en'   => 'Mobile Development',
                'category_ar'   => 'تطوير الجوال',
                'tags'          => json_encode(['Mobile App', 'React Native', 'Flutter', 'iOS', 'Android', 'Jordan']),
                'author'        => 'Alien Code Team',
                'meta_title_en' => 'Custom Mobile App Development Jordan | iOS & Android Apps — Alien Code',
                'meta_title_ar' => 'تطوير تطبيقات جوال مخصصة في الأردن | تطبيقات iOS وAndroid — كود أليين',
                'meta_desc_en'  => 'Alien Code builds custom iOS and Android mobile apps for businesses in Jordan and the Middle East. React Native, Flutter, and native development. Get a free quote.',
                'meta_desc_ar'  => 'يبني كود أليين تطبيقات جوال iOS وAndroid مخصصة للشركات في الأردن والشرق الأوسط. تطوير React Native وFlutter والتطوير الأصيل. احصل على عرض سعر مجاني.',
                'is_active'     => true,
                'published_at'  => Carbon::now()->subDays(7),
                'sort_order'    => 3,
            ],

            // =====================================================
            // POST 4 — Web Development Company Jordan
            // =====================================================
            [
                'slug'          => 'web-development-company-jordan-full-stack',
                'title_en'      => 'Full-Stack Web Development in Jordan: How Alien Code Builds for Scale',
                'title_ar'      => 'تطوير الويب الشامل في الأردن: كيف يبني كود أليين للتوسع',
                'excerpt_en'    => 'A deep-dive into Alien Code\'s full-stack web development capabilities — modern frontend frameworks, robust Laravel backends, cloud infrastructure, and DevOps practices.',
                'excerpt_ar'    => 'استعراض معمّق لقدرات كود أليين في تطوير الويب الشامل — أطر الواجهة الأمامية الحديثة، وخلفيات لارافيل المتينة، والبنية التحتية السحابية، وممارسات DevOps.',
                'body_en'       => <<<HTML
<h2>Beyond "Making Websites" — Engineering Digital Products</h2>
<p>The term "web development" undersells what Alien Code actually does. We engineer full-stack digital products — complex systems where every layer, from the database schema to the pixel on the browser, is designed with intention and built to last. For companies in Jordan and the wider MENA region, this approach makes the difference between a web presence and a genuine competitive advantage.</p>

<h2>Our Frontend Stack</h2>
<p>We work primarily with <strong>Vue.js</strong> and <strong>React</strong>, choosing based on project requirements. For content-heavy sites where SEO is paramount, we use <strong>Nuxt.js</strong> or <strong>Next.js</strong> for server-side rendering. Our frontend engineers are obsessive about Core Web Vitals — every project is optimized for LCP, FID, and CLS scores that keep Google happy.</p>

<h2>Our Backend Stack</h2>
<p><strong>Laravel</strong> is our primary backend framework, chosen for its maturity, security track record, and the exceptional ecosystem around it. We supplement Laravel with microservices written in <strong>Node.js</strong> (Fastify) for high-throughput real-time features — WebSockets, event streaming, and live dashboards.</p>

<h2>Database Architecture</h2>
<p>We design schemas for the long term:</p>
<ul>
  <li><strong>PostgreSQL</strong> — primary relational database for complex domains</li>
  <li><strong>MySQL / MariaDB</strong> — for high-read workloads and legacy system integration</li>
  <li><strong>Redis</strong> — caching, session management, and real-time pub/sub</li>
  <li><strong>Elasticsearch</strong> — full-text search with Arabic language analyzer support</li>
</ul>

<h2>Cloud & DevOps</h2>
<p>All our projects launch on cloud infrastructure — primarily <strong>AWS</strong> and <strong>DigitalOcean</strong>, with containerized deployments via <strong>Docker</strong> and orchestration through <strong>Kubernetes</strong> for large-scale systems. Our CI/CD pipelines (GitHub Actions, GitLab CI) ensure every code push is tested, reviewed, and deployed with zero manual intervention.</p>

<h2>Security by Default</h2>
<p>We treat security as a first-class feature: OWASP Top 10 compliance, automated dependency vulnerability scanning, WAF configuration, SSL/TLS hardening, and regular penetration testing for enterprise clients.</p>

<h2>Partner with Jordan's Full-Stack Experts</h2>
<p>Whether you are a startup launching your first product or an enterprise modernizing a legacy system, Alien Code has the depth to deliver. <a href="/contact">Contact us today</a> to discuss your project.</p>
HTML,
                'body_ar'       => <<<HTML
<h2>ما وراء "إنشاء المواقع الإلكترونية" — هندسة المنتجات الرقمية</h2>
<p>مصطلح "تطوير الويب" لا يوفي ما يفعله كود أليين حقاً. نحن نهندس منتجات رقمية شاملة — أنظمة معقدة حيث كل طبقة، من مخطط قاعدة البيانات إلى البكسل في المتصفح، مصممة بنية وبُنيت لتدوم. للشركات في الأردن ومنطقة الشرق الأوسط الأوسع، يصنع هذا النهج الفرق بين وجود على الويب وميزة تنافسية حقيقية.</p>

<h2>تواصل مع خبراء الويب الشامل في الأردن</h2>
<p>سواء كنت ناشئة تطلق أول منتج لها أو مؤسسة تحدّث نظاماً قديماً، لدى كود أليين العمق اللازم للتسليم. <a href="/contact">تواصل معنا اليوم</a> لمناقشة مشروعك.</p>
HTML,
                'image'         => 'blogs/full-stack-web-development-jordan.jpg',
                'category_en'   => 'Web Development',
                'category_ar'   => 'تطوير الويب',
                'tags'          => json_encode(['Full Stack', 'Vue.js', 'React', 'Laravel', 'DevOps', 'Jordan']),
                'author'        => 'Alien Code Team',
                'meta_title_en' => 'Full-Stack Web Development Jordan | Alien Code — Vue, React & Laravel Experts',
                'meta_title_ar' => 'تطوير الويب الشامل في الأردن | كود أليين — خبراء Vue وReact ولارافيل',
                'meta_desc_en'  => 'Alien Code delivers full-stack web development in Jordan — Vue.js, React, Laravel, cloud infrastructure, and DevOps. Build scalable digital products with Amman\'s best engineers.',
                'meta_desc_ar'  => 'يقدم كود أليين تطوير الويب الشامل في الأردن — Vue.js وReact ولارافيل والبنية التحتية السحابية وDevOps.',
                'is_active'     => true,
                'published_at'  => Carbon::now()->subDays(4),
                'sort_order'    => 4,
            ],

            // =====================================================
            // POST 5 — Software Development Amman
            // =====================================================
            [
                'slug'          => 'software-development-company-amman',
                'title_en'      => 'Why Amman is Becoming a Software Development Powerhouse (And How Alien Code is Leading the Charge)',
                'title_ar'      => 'لماذا تتحول عمّان إلى قوة عظمى في تطوير البرمجيات (وكيف يقود كود أليين هذا التحول)',
                'excerpt_en'    => 'Jordan\'s tech ecosystem is booming. Alien Code sits at the heart of Amman\'s software revolution — explore the trends, opportunities, and how we\'re helping regional businesses compete globally.',
                'excerpt_ar'    => 'يزدهر النظام البيئي التقني في الأردن. يقع كود أليين في قلب ثورة البرمجيات في عمّان — استكشف الاتجاهات والفرص وكيف نساعد الشركات الإقليمية على المنافسة عالمياً.',
                'body_en'       => <<<HTML
<h2>Amman's Quiet Tech Revolution</h2>
<p>While the global tech spotlight often falls on Dubai, Riyadh, or Cairo, <strong>Amman</strong> has been quietly building one of the Arab world's most sophisticated software engineering ecosystems. With world-class universities producing thousands of CS graduates annually, a government committed to digital transformation, and a growing wave of venture capital flowing into Jordanian startups, the conditions for a true software boom are in place.</p>

<h2>The Numbers Tell the Story</h2>
<p>Jordan's ICT sector employs over 20,000 professionals and contributes significantly to GDP, with year-on-year growth consistently outpacing the broader economy. Amman is home to regional offices of global technology companies alongside a thriving homegrown startup scene that has produced notable exits and unicorn-trajectory companies.</p>

<h2>Alien Code's Role in the Ecosystem</h2>
<p>Founded with a mission to build world-class software from Amman, Alien Code has grown into a full-service digital product studio. We work with Jordanian enterprises modernizing legacy systems, regional startups building their first products, and international companies looking for a high-quality nearshore development partner in the Middle East.</p>

<h2>Our Core Capabilities</h2>
<ul>
  <li>Custom web application development (Laravel, Vue.js, React)</li>
  <li>Mobile app development (React Native, Flutter, Swift, Kotlin)</li>
  <li>AI &amp; machine learning integration</li>
  <li>Enterprise system integration (ERP, CRM, third-party APIs)</li>
  <li>UI/UX design and product strategy</li>
  <li>DevOps, cloud migration, and infrastructure automation</li>
  <li>Technical due diligence and code audits</li>
</ul>

<h2>What Makes Us Different</h2>
<p><strong>Ownership culture</strong> — our engineers treat your product like their own. We are not a body shop rotating contractors through anonymous tickets. Every client has a dedicated account engineering team that understands the business context behind every feature decision.</p>
<p><strong>Arabic-first thinking</strong> — we build for the MENA market natively: RTL layouts, Arabic NLP, local payment gateways, and compliance with regional data regulations are competencies we bring by default.</p>
<p><strong>Transparency</strong> — weekly progress reports, live project dashboards, and direct access to your engineering team at all times.</p>

<h2>Collaborate with Amman's Best</h2>
<p>If you are looking for a <strong>software development company in Amman</strong> that combines technical excellence with genuine partnership, <a href="/contact">let's start a conversation</a>.</p>
HTML,
                'body_ar'       => <<<HTML
<h2>الثورة التقنية الهادئة في عمّان</h2>
<p>بينما يتركز الضوء التقني العالمي في كثير من الأحيان على دبي والرياض والقاهرة، كانت <strong>عمّان</strong> تبني بهدوء أحد أكثر منظومات هندسة البرمجيات تطوراً في العالم العربي. بجامعات عالمية المستوى تخرّج آلاف الخريجين في علوم الحاسوب سنوياً، وحكومة ملتزمة بالتحول الرقمي، وموجة متنامية من رأس المال الجريء المتدفق إلى الشركات الناشئة الأردنية، الظروف لازدهار برمجي حقيقي باتت متوفرة.</p>

<h2>ما يميزنا</h2>
<p><strong>ثقافة الملكية</strong> — يعامل مهندسونا منتجك كأنه ملكهم. نحن لسنا متعاقدين مؤقتين نتناوب على بطاقات مجهولة الهوية.</p>
<p><strong>التفكير العربي أولاً</strong> — نبني للسوق الإقليمية بشكل أصيل: تخطيطات RTL، ومعالجة اللغة العربية، وبوابات الدفع المحلية، والامتثال للوائح البيانات الإقليمية كلها كفاءات نقدمها بشكل افتراضي.</p>

<h2>تعاون مع أفضل كفاءات عمّان</h2>
<p>إذا كنت تبحث عن <strong>شركة تطوير برمجيات في عمّان</strong> تجمع بين التميز التقني والشراكة الحقيقية، <a href="/contact">لنبدأ محادثة</a>.</p>
HTML,
                'image'         => 'blogs/software-development-amman.jpg',
                'category_en'   => 'Company',
                'category_ar'   => 'الشركة',
                'tags'          => json_encode(['Software Development', 'Amman', 'Jordan', 'Tech Hub', 'Digital Transformation']),
                'author'        => 'Alien Code Team',
                'meta_title_en' => 'Software Development Company Amman | Alien Code — Jordan\'s Tech Leaders',
                'meta_title_ar' => 'شركة تطوير برمجيات في عمّان | كود أليين — قادة التقنية في الأردن',
                'meta_desc_en'  => 'Alien Code is a leading software development company in Amman, Jordan. Web apps, mobile apps, AI solutions, and DevOps. Your regional tech partner for digital growth.',
                'meta_desc_ar'  => 'كود أليين شركة تطوير برمجيات رائدة في عمّان، الأردن. تطبيقات ويب وجوال وحلول ذكاء اصطناعي وDevOps.',
                'is_active'     => true,
                'published_at'  => Carbon::now()->subDays(2),
                'sort_order'    => 5,
            ],

            // =====================================================
            // POST 6 — E-commerce Development Jordan
            // =====================================================
            [
                'slug'          => 'ecommerce-development-jordan-alien-code',
                'title_en'      => 'E-commerce Development in Jordan: Building Online Stores That Actually Sell',
                'title_ar'      => 'تطوير التجارة الإلكترونية في الأردن: بناء متاجر إلكترونية تبيع فعلاً',
                'excerpt_en'    => 'Alien Code builds high-converting e-commerce platforms for Jordanian and regional businesses — custom-built on Laravel with Arabic UX, local payment gateways, and conversion-focused design.',
                'excerpt_ar'    => 'يبني كود أليين منصات تجارة إلكترونية عالية التحويل للشركات الأردنية والإقليمية — مبنية على لارافيل مع تجربة مستخدم عربية وبوابات دفع محلية وتصميم يركز على التحويل.',
                'body_en'       => <<<HTML
<h2>E-commerce in the MENA Region: The Opportunity Is Now</h2>
<p>The MENA e-commerce market is projected to exceed $50 billion by 2026, with Jordan among the fastest-growing markets in the region. Yet most Jordanian businesses are still running on off-the-shelf platforms that limit their growth, lock them into third-party ecosystems, and fail to deliver the Arabic-first user experience their customers deserve.</p>
<p><strong>Alien Code</strong> builds custom e-commerce platforms that are designed specifically for your business model, your products, and your customers — not adapted from a generic template.</p>

<h2>What a Custom E-commerce Platform Unlocks</h2>
<ul>
  <li>Full control over UX/UI — no template constraints</li>
  <li>Custom pricing rules, discount engines, and loyalty programs</li>
  <li>Native Arabic experience with proper RTL support</li>
  <li>Integration with local payment gateways: eFAWATEERcom, Hyperpay, PayFort, MyFatoorah</li>
  <li>Cash on delivery workflows — still critical in the Jordanian market</li>
  <li>Custom shipping and fulfillment logic</li>
  <li>Deep analytics and business intelligence dashboards</li>
  <li>B2B e-commerce with account-based pricing and purchase order workflows</li>
</ul>

<h2>Our E-commerce Tech Stack</h2>
<p>We build on <strong>Laravel</strong> with a <strong>Vue.js / Nuxt.js</strong> frontend for maximum performance and SEO. Server-side rendering ensures your product pages rank on Google, load fast, and convert browsers to buyers. For inventory-heavy operations, we integrate with ERP systems and build custom warehouse management features.</p>

<h2>Performance That Drives Revenue</h2>
<p>A 1-second improvement in page load time can increase conversions by up to 7%. Our e-commerce builds are aggressively optimized: image CDN delivery, database query optimization, Redis caching, and lazy loading are standard — not add-ons.</p>

<h2>Post-Launch Growth Partnership</h2>
<p>We do not disappear after launch. Our growth engineering team helps you A/B test checkout flows, optimize product page SEO, implement abandoned cart recovery, and build the analytics infrastructure to understand what is actually driving your sales.</p>

<h2>Build an E-commerce Platform That Grows With You</h2>
<p>Ready to move beyond the limitations of off-the-shelf platforms? <a href="/contact">Talk to Alien Code</a> about your e-commerce vision — we will scope it, price it, and deliver it.</p>
HTML,
                'body_ar'       => <<<HTML
<h2>التجارة الإلكترونية في منطقة الشرق الأوسط وشمال أفريقيا: الفرصة الآن</h2>
<p>من المتوقع أن يتجاوز سوق التجارة الإلكترونية في منطقة الشرق الأوسط وشمال أفريقيا 50 مليار دولار بحلول عام 2026، مع كون الأردن من أسرع الأسواق نمواً في المنطقة. ومع ذلك، لا تزال معظم الشركات الأردنية تعمل على منصات جاهزة تحد من نموها وتقيدها في منظومات الطرف الثالث.</p>
<p><strong>كود أليين</strong> يبني منصات تجارة إلكترونية مخصصة مصممة خصيصاً لنموذج عملك ومنتجاتك وعملائك — وليس مقتبسة من قالب عام.</p>

<h2>ابن منصة تجارة إلكترونية تنمو معك</h2>
<p>هل أنت مستعد للتخلص من قيود المنصات الجاهزة؟ <a href="/contact">تحدث مع كود أليين</a> عن رؤيتك للتجارة الإلكترونية — سنحدد نطاقها ونسعّرها ونسلمها.</p>
HTML,
                'image'         => 'blogs/ecommerce-development-jordan.jpg',
                'category_en'   => 'E-commerce',
                'category_ar'   => 'التجارة الإلكترونية',
                'tags'          => json_encode(['E-commerce', 'Online Store', 'Laravel', 'Jordan', 'Arabic', 'Payment Gateway']),
                'author'        => 'Alien Code Team',
                'meta_title_en' => 'E-commerce Development Jordan | Custom Online Stores — Alien Code Amman',
                'meta_title_ar' => 'تطوير التجارة الإلكترونية في الأردن | متاجر إلكترونية مخصصة — كود أليين عمّان',
                'meta_desc_en'  => 'Alien Code builds custom e-commerce platforms for Jordanian businesses. Arabic UX, local payment gateways, Laravel + Vue.js. High-converting online stores built to scale.',
                'meta_desc_ar'  => 'يبني كود أليين منصات تجارة إلكترونية مخصصة للشركات الأردنية. تجربة مستخدم عربية وبوابات دفع محلية ولارافيل + Vue.js.',
                'is_active'     => true,
                'published_at'  => Carbon::now(),
                'sort_order'    => 6,
            ],

        ];

        DB::table('blogs')->insert($blogs);
    }
}
