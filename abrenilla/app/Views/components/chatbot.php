<div id="chatbot-container">
  <button id="toggle-chatbot" class="btn btn-primary rounded-circle shadow-lg" style="width: 60px; height: 60px;">
    <i class="fas fa-robot"></i>
  </button>
  <div id="chatbot-box" class="card shadow" style="display: none;">
    <div id="chatbot-header" class="card-header d-flex justify-content-between align-items-center text-white"
         style="background: linear-gradient(to right, #0052cc, #003d82); cursor: move;">
      <div class="d-flex align-items-center">
        <img src="https://cdn-icons-png.flaticon.com/512/4712/4712105.png" width="32" class="me-2" alt="Kai" />
        <strong> Ask Kai</strong>
      </div>
      <button class="btn-close btn-close-white" onclick="document.getElementById('chatbot-box').style.display='none';"></button>
    </div>
    <div class="card-body" id="chat-messages" style="height: 300px; overflow-y: auto; background-color: #f9f9fb;"></div>
    <div class="card-footer bg-white border-top">
      <div class="input-group">
        <input type="text" id="chat-input" class="form-control border-0 shadow-sm" placeholder="Ask Kai anything..." autocomplete="off">
        <button class="btn btn-outline-secondary" id="mic-button" type="button" title="Voice input">
          <i class="fas fa-microphone"></i>
        </button>
        <button class="btn btn-primary" id="send-button" type="button">
          <i class="fas fa-paper-plane"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<style>
  #chatbot-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
  }

  #chatbot-box {
    width: 350px;
    position: absolute;
    top: 70px;
    right: 0;
    border-radius: 12px;
    overflow: hidden;
    z-index: 9999;
  }

  .chatbot-message {
    padding: 8px 12px;
    margin: 5px 10px;
    border-radius: 12px;
    max-width: 85%;
    word-wrap: break-word;
    font-size: 14px;
  }

  .chatbot-message.user {
    background-color: #dcf4ff;
    align-self: flex-end;
    text-align: right;
    margin-left: auto;
  }

  .chatbot-message.bot {
    background-color: #f0f2f5;
    align-self: flex-start;
    text-align: left;
    margin-right: auto;
  }

  .typing-indicator {
    font-style: italic;
    color: gray;
    padding: 8px 12px;
    margin: 5px 10px;
  }

  #chat-messages {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 10px 0;
  }

  #mic-button.listening {
    background-color: #dc3545 !important;
    color: white;
  }

  @media (max-width: 400px) {
    #chatbot-box {
      width: 90%;
      right: 5%;
    }
  }
</style>

<script>
  let recognizing = false;
  let recognition;

  window.onload = function () {
    const box = document.getElementById('chatbot-box');
    box.style.display = 'block';
    makeDraggable(document.getElementById('chatbot-box'), document.getElementById('chatbot-header'));
    appendMessage('bot', '👋 Hello! I\'m Kai 🤖, your smart assistant. How can I help you today?');
  };

  document.getElementById('toggle-chatbot').addEventListener('click', function () {
    const box = document.getElementById('chatbot-box');
    const input = document.getElementById('chat-input');
    box.style.display = (box.style.display === 'none') ? 'block' : 'none';
    input.focus();
  });

  document.getElementById('chat-input').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      sendMessage();
    }
  });

  document.getElementById('send-button').addEventListener('click', sendMessage);

  document.getElementById('mic-button').addEventListener('click', function () {
    const micBtn = document.getElementById('mic-button');

    if (!('webkitSpeechRecognition' in window)) {
      alert('Sorry, your browser does not support voice input.');
      return;
    }

    if (!recognition) {
      recognition = new webkitSpeechRecognition();
      recognition.continuous = false;
      recognition.lang = 'en-US';

      recognition.onstart = () => {
        recognizing = true;
        micBtn.classList.add('listening');
      };
      recognition.onend = () => {
        recognizing = false;
        micBtn.classList.remove('listening');
      };
      recognition.onerror = (e) => {
        console.log('Voice error:', e);
        micBtn.classList.remove('listening');
      };
      recognition.onresult = (e) => {
        const text = e.results[0][0].transcript;
        document.getElementById('chat-input').value = text;
        sendMessage();
      };
    }

    if (!recognizing) recognition.start();
    else recognition.stop();
  });

  function sendMessage() {
    const input = document.getElementById('chat-input');
    const message = input.value.trim();
    if (!message) return;

    appendMessage('user', message);
    input.value = '';

    const container = document.getElementById('chat-messages');
    const typingIndicator = document.createElement('div');
    typingIndicator.className = 'typing-indicator';
    typingIndicator.textContent = 'Kai is typing...';
    container.appendChild(typingIndicator);
    container.scrollTop = container.scrollHeight;

    fetch('/chatbot/respond', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
      container.removeChild(typingIndicator);
      appendMessage('bot', data.reply || 'Kai could not respond.');
      speakText(data.reply || 'Kai could not respond.');
    })
    .catch(() => {
      container.removeChild(typingIndicator);
      appendMessage('bot', '⚠️ Error connecting to Kai. Please try again.');
    });
  }

  function appendMessage(sender, text) {
    const container = document.getElementById('chat-messages');
    const div = document.createElement('div');
    div.className = 'chatbot-message ' + sender;
    div.textContent = text;
    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
  }

  function speakText(text) {
    if (!('speechSynthesis' in window)) return;
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'en-US';
    speechSynthesis.speak(utterance);
  }

  function makeDraggable(elmnt, handle) {
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    handle.onmousedown = dragMouseDown;

    function dragMouseDown(e) {
      e.preventDefault();
      pos3 = e.clientX;
      pos4 = e.clientY;
      document.onmouseup = closeDragElement;
      document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
      e.preventDefault();
      pos1 = pos3 - e.clientX;
      pos2 = pos4 - e.clientY;
      pos3 = e.clientX;
      pos4 = e.clientY;
      elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
      elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
      document.onmouseup = null;
      document.onmousemove = null;
    }
  }
</script>
