import ollama from 'ollama';

async function correctText(inputText) {
  const response = await ollama.chat({
    model: 'phi3:mini', // Ensure you're using the correct model
    messages: [
      {
        role: 'user',
        content: `Please correct the following text for spelling and grammar errors and return only the corrected text, with no explanations or annotations: "${inputText}"`
      }
    ],
  });

  // Print only the corrected content
  console.log(response.message.content.trim());
}

// Get the input text from command line arguments
const inputText = process.argv.slice(2).join(" ");
correctText(inputText);
