@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
@endpush

@section('content')
    @php
        $user = Auth::guard('web')->user();
        $employee = Auth::guard('employee')->check() ? Auth::guard('employee')->user() : null;
    @endphp

    <header>
        <h1><svg class="icon" width="24" height="24" viewBox="0 0 48 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="5" width="38" height="38" rx="3" fill="none" stroke="#00A27F"
                    stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M34 21L37 24L34 27" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M14 21L11 24L14 27" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M27 14L24 11L21 14" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M27 34L24 37L21 34" stroke="#00A27F" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg> <span data-i18n="support_service">Support service</span></h1>
        <div class="header-right">
            <i class="fas fa-envelope secure-icon"></i>
            <div class="user-info">
                <i class="fas fa-user-circle user-icon"></i>
                <div class="user-details">
                    @if ($user)
                        <span class="user-name">{{ $user->firstName }} {{ $user->lastName }}</span>
                        <span class="user-role">Admin</span>
                    @elseif ($employee)
                        <span class="user-name">{{ $employee->username }}</span>
                        <span class="user-role">Employee</span>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="help-box">
            <h4 data-i18n="need_help">Need a help?</h4>
            <div style="display: flex; gap:5px;">
                <p data-i18n="contact_us">Please contact us at  </p>
                <a href="mailto:bakda2365@gmail.com"> bakda2365@gmail.com</a>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span data-i18n="faq_1_q">How do I add a new product? </span><svg width="24"
                    height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M36 18L24 30L12 18" stroke="#333" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg></div>
            <div class="faq-answer">
                <span data-i18n="faq_1_a">Go to the “Clients” section → click the “Add client” button → Fill out the form
                    and click “Save”.</span>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span data-i18n="faq_2_q">I forgot the password. What to do?</span> <svg
                    width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M36 18L24 30L12 18" stroke="#333" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg></div>
            <div class="faq-answer">
                <span data-i18n="faq_2_a">On the login page, click “Forgot your password?”. Enter your email address and we
                    will send you a recovery link.</span>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span data-i18n="faq_3_q">How do I add a new cashier or employee?</span> <svg
                    width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M36 18L24 30L12 18" stroke="#333" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg></div>
            <div class="faq-answer">
                <span data-i18n="faq_3_a">Go to “Employee” → click “Add employee” → Fill out the form.</span>
            </div>
        </div>


        <div class="ai-chat-box">
            <div>
                <div class="ai-header-btn">
                    <button id="expandBtn" class="expand-btn" type="button" title="Expand" onclick="expandChat()">
                        <svg width="14" height="14" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 42H6V26" stroke="#333" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M26 6H42V22" stroke="#333" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>

                    <button class="collapse-btn" onclick="collapseChat()">×</button>
                </div>

                <div class="chat-header">
                    <div class="chat-bubble">
                        Hi! I’m your assistant <span class="smartai-name">SmartAI</span><br>
                        How can I help?
                    </div>
                </div>
                

                <div id="chatMessages" class="chat-messages"></div>

                
            </div>

            <form id="chatForm" class="chat-footer">
                <textarea id="userMessage" placeholder="Type your message . . ."></textarea>
                <button type="submit" class="send-btn">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path fill="currentColor" d="M2 21l21-9L2 3v7l15 2-15 2v7z" />
                    </svg>
                </button>
            </form>

        </div>

        {{-- <div class="ai-chat-box">
            <h4 class="chat-title">🤖 Ask SmartKasip AI</h4>
            <form id="chatForm">
                <textarea id="userMessage" class="form-control ai-textarea" rows="4" placeholder="Type your question..."></textarea>
                <button type="submit" class="aiBtn">Ask AI</button>
            </form>
            <div id="aiResponse" class="ai-response-box"></div>
        </div> --}}
    </div>


    <script src="{{ asset('js/support.js') }}"></script>
    <script src="../js/lang.js"></script>
    <script>
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('userMessage');
        const chatMessages = document.getElementById('chatMessages');
    
        chatForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const userText = messageInput.value.trim();
            if (!userText) return;
    
            // Show user message
            addMessage('user', userText);
            messageInput.value = '';
    
            // Show temporary loading message
            const loadingMessage = addMessage('ai', 'Thinking...');
    
            try {
                const response = await fetch("{{ route('ai.chat') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: userText })
                });
    
                const data = await response.json();
                loadingMessage.textContent = data.reply || 'No response from AI.';
            } catch (err) {
                loadingMessage.textContent = "Error: " + err.message;
            }
        });
    
        function addMessage(role, text) {
            const bubble = document.createElement('div');
            bubble.className = `chat-bubble ${role}`;
            bubble.textContent = text;
            chatMessages.appendChild(bubble);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            return bubble;
        }
    </script>
    
    
@endsection
