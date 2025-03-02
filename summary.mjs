import ollama from 'ollama';

async function correctText(inputText) {
  try {
    console.time('SummaryExecutionTime'); // Start the timer

    const response = await ollama.chat({
      model: 'llama-pro', // Use the appropriate model
      messages: [
        {
          role: 'user',
          content: `Provide a very small summary with only the most important points for the book "${inputText}".`
        }
      ],
    });

    console.timeEnd('SummaryExecutionTime'); // End the timer and log the time

    // Check the response structure and print the summary content
    if (response && response.message && response.message.content) {
      console.log(response.message.content.trim());
    } else {
      console.error('Error: Response does not contain the expected content.');
    }
  } catch (error) {
    console.error('Error while generating summary:', error);
  }
}

// Get the input text from command line arguments
const inputText = process.argv.slice(2).join(" ");
if (inputText) {
  correctText(inputText);
} else {
  console.error('Error: No input text provided.');
}
