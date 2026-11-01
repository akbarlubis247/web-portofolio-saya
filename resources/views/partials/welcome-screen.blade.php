{{-- Cinematic Editorial Dual-Curtain Welcome Screen --}}
<div id="welcome-wrapper" class="select-none">
    {{-- Left Curtain Shutter Panel --}}
    <div id="curtain-panel-left" 
         class="fixed top-0 left-0 w-1/2 h-full bg-[#1D2A35] z-[9990] transition-transform duration-[850ms] ease-[cubic-bezier(0.85,0,0.15,1)] will-change-transform border-r border-[#D5B98C]/20 shadow-2xl">
        {{-- Subtle architectural grid inside curtain --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#D5B98C 1px, transparent 1px); background-size: 28px 28px;"></div>
    </div>

    {{-- Right Curtain Shutter Panel --}}
    <div id="curtain-panel-right" 
         class="fixed top-0 right-0 w-1/2 h-full bg-[#1D2A35] z-[9990] transition-transform duration-[850ms] ease-[cubic-bezier(0.85,0,0.15,1)] will-change-transform border-l border-[#D5B98C]/20 shadow-2xl">
        {{-- Subtle architectural grid inside curtain --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#D5B98C 1px, transparent 1px); background-size: 28px 28px;"></div>
    </div>

    {{-- Interactive Welcome Stage Container --}}
    <div id="welcome-screen" 
         class="fixed inset-0 z-[9995] w-screen h-screen flex flex-col justify-between overflow-hidden bg-[#1D2A35] text-[#F6F1E7]">
        
        {{-- Ambient Lighting Blooms --}}
        <div class="absolute -top-32 -left-32 w-[520px] h-[520px] rounded-full bg-[#467C78]/25 blur-[130px] pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-[520px] h-[520px] rounded-full bg-[#D5B98C]/20 blur-[130px] pointer-events-none"></div>

        {{-- Background Blurred Glow of Illustration --}}
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none">
            <img src="{{ asset('images/welcome-illustration.jpg') }}" alt="" 
                 class="w-full h-full object-cover filter blur-3xl scale-125 opacity-20 transition-all duration-1000">
        </div>

        {{-- Main Visual Canvas with Interactive 3D Cursor Tilt --}}
        <div id="welcome-tilt-container" class="absolute inset-0 w-full h-full flex items-center justify-center overflow-hidden transition-transform duration-300 ease-out will-change-transform">
            <img src="{{ asset('images/welcome-illustration.jpg') }}" 
                 alt="Selamat Datang di Portofolio Saya" 
                 id="welcome-main-img"
                 class="w-full h-full object-cover object-center transform scale-105 opacity-0 filter blur-md transition-all duration-[1100ms] ease-[cubic-bezier(0.16,1,0.3,1)]">
            
            {{-- Cinematic Vignette and Editorial Dark Scrim --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#1D2A35] via-[#1D2A35]/50 to-[#1D2A35]/40 pointer-events-none"></div>
            <div class="absolute inset-0 bg-radial from-transparent via-[#1D2A35]/30 to-[#1D2A35]/80 pointer-events-none"></div>
        </div>

        {{-- Center/Bottom Editorial Content Stack (Staggered Entrance) --}}
        <main class="relative z-10 w-full max-w-[1280px] mx-auto px-6 sm:px-10 my-auto py-8">
            <div class="max-w-3xl">
                {{-- Stagger 1: Bold Editorial Heading --}}
                <h1 id="welcome-step-2" class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-[#F6F1E7] tracking-tight leading-[1.08] mb-8 opacity-0 transform translate-y-6 transition-all duration-700 delay-150 ease-[cubic-bezier(0.16,1,0.3,1)]">
                    WELCOME TO <br>
                    <span class="font-serif-italic font-normal text-[#D5B98C]">MY PORTFOLIO</span>
                </h1>

                {{-- Stagger 2: Primary "LET'S EXPLORE" Magnetic Button --}}
                <div id="welcome-step-4" class="flex items-center opacity-0 transform translate-y-6 transition-all duration-700 delay-300 ease-[cubic-bezier(0.16,1,0.3,1)]">
                    <div class="relative group inline-block">
                        {{-- Ambient Button Glow --}}
                        <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-[#D5B98C] via-[#467C78] to-[#D5B98C] opacity-50 blur-lg group-hover:opacity-100 transition-opacity duration-300"></div>

                        <button id="welcome-next-btn" 
                                type="button" 
                                data-magnetic="true"
                                class="btn-magnetic relative inline-flex items-center gap-4 px-10 sm:px-12 py-4 sm:py-5 rounded-2xl bg-[#D5B98C] text-[#1D2A35] font-extrabold text-sm sm:text-base font-mono tracking-wider shadow-2xl hover:bg-[#F6F1E7] active:scale-95 transition-all duration-300 cursor-pointer">
                            <span id="welcome-btn-text">LET'S EXPLORE</span>
                            <span id="welcome-btn-arrow" class="text-lg transition-transform duration-300 group-hover:translate-x-2">&rarr;</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>

        {{-- Bottom Status Footer Bar --}}
        <footer id="welcome-bottom" class="relative z-10 w-full max-w-[1280px] mx-auto px-6 sm:px-10 pb-6 sm:pb-8 flex items-center justify-between text-xs font-mono text-[#D7D8D1]/60 opacity-0 transform translate-y-6 transition-all duration-700 delay-500 ease-[cubic-bezier(0.16,1,0.3,1)]">
            <span>&copy; {{ date('Y') }} {{ $settings->name }}</span>
            <div class="flex items-center gap-4">
                <span>PRESS ESC TO SKIP</span>
            </div>
        </footer>
    </div>
</div>

{{-- Welcome Screen Controller Script (Staggered Entrance, 3D Tilt & Dual Curtain Exit/Replay) --}}
<script>
    (function() {
        const welcomeWrapper = document.getElementById('welcome-wrapper');
        const welcomeScreen = document.getElementById('welcome-screen');
        const curtainLeft = document.getElementById('curtain-panel-left');
        const curtainRight = document.getElementById('curtain-panel-right');
        const mainImg = document.getElementById('welcome-main-img');
        const tiltContainer = document.getElementById('welcome-tilt-container');
        const step2 = document.getElementById('welcome-step-2');
        const step4 = document.getElementById('welcome-step-4');
        const nextBtn = document.getElementById('welcome-next-btn');
        const btnText = document.getElementById('welcome-btn-text');
        const btnArrow = document.getElementById('welcome-btn-arrow');

        if (!welcomeScreen || !nextBtn) return;

        let isExiting = false;

        // Check if user came from hash (#projects) or has explored previously in this session
        const hasHash = window.location.hash.length > 0;
        const alreadyWelcomed = sessionStorage.getItem('portfolio_welcomed') === 'true';

        if (hasHash && alreadyWelcomed) {
            hideWelcomeInstant();
        } else {
            document.body.style.overflow = 'hidden';
            playEntranceAnimation();
        }

        function hideWelcomeInstant() {
            if (welcomeWrapper) welcomeWrapper.style.display = 'none';
            document.body.style.overflow = '';
        }

        // 1. STAGGERED REVEAL ENTRANCE
        function playEntranceAnimation() {
            welcomeWrapper.style.display = 'block';
            welcomeScreen.style.opacity = '1';
            welcomeScreen.style.pointerEvents = 'auto';

            // Reset curtains
            if (curtainLeft) curtainLeft.style.transform = 'translateX(0)';
            if (curtainRight) curtainRight.style.transform = 'translateX(0)';

            requestAnimationFrame(() => {
                setTimeout(() => {
                    // Image reveal & zoom
                    if (mainImg) {
                        mainImg.style.transform = 'scale(1)';
                        mainImg.style.opacity = '1';
                        mainImg.style.filter = 'blur(0px)';
                    }
                    if (step2) {
                        step2.style.opacity = '1';
                        step2.style.transform = 'translateY(0)';
                    }
                    if (step4) {
                        step4.style.opacity = '1';
                        step4.style.transform = 'translateY(0)';
                    }
                }, 80);
            });
        }

        // 2. INTERACTIVE 3D MOUSE TILT ON WELCOME ILLUSTRATION
        if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
            window.addEventListener('mousemove', (e) => {
                if (isExiting || !tiltContainer || welcomeWrapper.style.display === 'none') return;
                const x = (e.clientX / window.innerWidth) - 0.5;
                const y = (e.clientY / window.innerHeight) - 0.5;
                // Subtle tilt up to 3.5 degrees
                tiltContainer.style.transform = `perspective(1000px) rotateX(${-y * 5}deg) rotateY(${x * 5}deg) scale(1.02)`;
            });
        }

        // 3. CINEMATIC DUAL-CURTAIN EXIT TRANSITION
        function triggerCurtainExit() {
            if (isExiting) return;
            isExiting = true;
            sessionStorage.setItem('portfolio_welcomed', 'true');

            // Button feedback
            if (btnText) btnText.textContent = 'EXPLORING...';
            if (btnArrow) btnArrow.style.transform = 'translateX(8px)';
            nextBtn.style.pointerEvents = 'none';

            // Play audio if enabled
            if (window.portfolioAudio) {
                window.portfolioAudio.playCurtain();
            }

            // Text elements fade out fast
            [step2, step4].forEach(el => {
                if (el) {
                    el.style.transition = 'all 0.3s ease';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-12px)';
                }
            });

            // Illustration zooms softly into viewer
            if (mainImg) {
                mainImg.style.transition = 'transform 0.8s cubic-bezier(0.8, 0, 0.2, 1), opacity 0.6s ease';
                mainImg.style.transform = 'scale(1.12)';
                mainImg.style.opacity = '0';
            }

            // Split Curtain panels slide open to left & right
            setTimeout(() => {
                if (curtainLeft) curtainLeft.style.transform = 'translateX(-100%)';
                if (curtainRight) curtainRight.style.transform = 'translateX(100%)';

                // Unlock scrolling
                document.body.style.overflow = '';
            }, 180);

            // Hide wrapper after transition completes
            setTimeout(() => {
                welcomeWrapper.style.display = 'none';
                isExiting = false;
                if (btnText) btnText.textContent = "LET'S EXPLORE";
                if (btnArrow) btnArrow.style.transform = '';
                nextBtn.style.pointerEvents = 'auto';
            }, 1050);
        }

        // Click next button
        nextBtn.addEventListener('click', triggerCurtainExit);

        // Keyboard press Enter or Space or Escape
        window.addEventListener('keydown', (e) => {
            if (welcomeWrapper.style.display === 'none' || isExiting) return;
            if (e.key === 'Enter' || e.key === ' ' || e.key === 'Escape') {
                if (document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    triggerCurtainExit();
                }
            }
        });

        // 4. GLOBAL REOPEN / REPLAY HOOK (Callable from Navbar without page reload)
        window.openWelcomeScreen = function() {
            if (isExiting) return;
            welcomeWrapper.style.display = 'block';
            document.body.style.overflow = 'hidden';

            // Reset text transforms
            [step2, step4].forEach(el => {
                if (el) {
                    el.style.transition = '';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(16px)';
                }
            });
            if (mainImg) {
                mainImg.style.transition = '';
                mainImg.style.opacity = '0';
                mainImg.style.transform = 'scale(1.08)';
            }

            // Curtains close back in
            if (curtainLeft) curtainLeft.style.transform = 'translateX(0)';
            if (curtainRight) curtainRight.style.transform = 'translateX(0)';

            if (window.portfolioAudio) {
                window.portfolioAudio.playCurtain();
            }

            // Re-trigger entrance animations
            setTimeout(() => {
                playEntranceAnimation();
            }, 400);
        };
    })();
</script>
