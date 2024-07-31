// const messageInput = document.getElementById("message-input");
// const sendButton = document.getElementById("send-button");
// const chatMessages = document.querySelector(".chat-messages");

// sendButton.addEventListener("click", sendMessage);
// messageInput.addEventListener("keypress", function (event) {
//   if (event.key === "Enter") {
//     sendMessage();
//   }
// });

// function sendMessage() {
//   const message = messageInput.value;
//   if (message.trim() !== "") {
//     const messageElement = document.createElement("div");
//     messageElement.classList.add("message", "sent");
//     messageElement.innerText = message;
//     chatMessages.appendChild(messageElement);
//     messageInput.value = "";
//     chatMessages.scrollTop = chatMessages.scrollHeight;
//     simulateReply(); // Simulate receiving a reply
//   }
// }

// function simulateReply() {
//   setTimeout(function () {
//     // const reply = "This is a reply.";
//     const replyElement = document.createElement("div");
//     replyElement.classList.add("message", "received");
//     replyElement.innerText = reply;
//     chatMessages.appendChild(replyElement);
//     chatMessages.scrollTop = chatMessages.scrollHeight;
//   }, 1000); // Simulate a delayed reply
// }
const messageInput = document.getElementById("message-input");
const sendButton = document.getElementById("send-button");
const chatMessages = document.querySelector(".chat-messages");

sendButton.addEventListener("click", sendMessage);
messageInput.addEventListener("keypress", function (event) {
  if (event.key === "Enter") {
    sendMessage();
  }
});

function sendMessage() {
  const message = messageInput.value;
  if (message.trim() !== "") {
    const messageElement = document.createElement("div");
    messageElement.classList.add("message", "sent");
    messageElement.innerText = message;
    chatMessages.appendChild(messageElement);
    messageInput.value = "";
    chatMessages.scrollTop = chatMessages.scrollHeight;
    simulateReply(); // Simulate receiving a reply
  }
}

function simulateReply() {
  setTimeout(function () {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "get_reply.php", true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        const reply = xhr.responseText;
        const replyElement = document.createElement("div");
        replyElement.classList.add("message", "received");
        replyElement.innerText = reply;
        chatMessages.appendChild(replyElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }
    };
    xhr.send();
  }, 1000); // Simulate a delayed reply
}

// Periodically load new chat messages every 3 seconds
setInterval(loadChatMessages, 3000);

function loadChatMessages() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "get_messages.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      chatMessages.innerHTML = xhr.responseText;
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  };
  xhr.send();
}
