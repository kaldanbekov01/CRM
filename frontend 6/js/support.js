document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
        const answer = item.nextElementSibling;
        const isOpen = answer.classList.contains('open');

        // Toggle this one only
        if (isOpen) {
            answer.classList.remove('open');
            item.classList.remove('active');
        } else {
            answer.classList.add('open');
            item.classList.add('active');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const burger = document.querySelector('.burger');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.overlay');
    const body = document.body;

    function openSidebar() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        body.classList.remove('sidebar-open');
    }

    burger.addEventListener('click', function () {
        openSidebar();
    });

    overlay.addEventListener('click', function () {
        closeSidebar();
    });
});

function expandChat() {
    const chatBox = document.querySelector('.ai-chat-box');
    document.body.classList.add('chat-expanded');
    chatBox.classList.add('fullscreen');
}


function collapseChat() {
  const chatBox = document.querySelector('.ai-chat-box');
  document.body.classList.remove('chat-expanded');
  chatBox.classList.remove('fullscreen');
}

function expandChat() {
    const chatBox = document.querySelector('.ai-chat-box');
    const expandBtn = document.getElementById('expandBtn');
    const collapseBtn = document.getElementById('collapseBtn');
  
    chatBox.classList.add('fullscreen');
    document.body.classList.add('chat-expanded');
    
    expandBtn.style.display = 'none';
    collapseBtn.style.display = 'block';
  }
  
  function collapseChat() {
    const chatBox = document.querySelector('.ai-chat-box');
    const expandBtn = document.getElementById('expandBtn');
    const collapseBtn = document.getElementById('collapseBtn');
  
    chatBox.classList.remove('fullscreen');
    document.body.classList.remove('chat-expanded');
    
    expandBtn.style.display = 'block';
    collapseBtn.style.display = 'none';
  }