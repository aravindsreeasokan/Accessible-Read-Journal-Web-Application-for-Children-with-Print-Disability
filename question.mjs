import ollama from 'ollama';

async function correctText(inputText) {
  const response = await ollama.chat({
    model: 'phi3:mini', // Use the appropriate model here
    messages: [
      {
        role: 'user',
        content: `provide a question and 4 option and the correct option based on the book "${inputText}"`
      }
    ],
  });

  // Print only the corrected content
  console.log(response.message.content.trim());
}

// Get the input text from command line arguments
const inputText = process.argv.slice(2).join(" ");
correctText(inputText);
