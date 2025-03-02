const { GoogleGenerativeAI } = require("@google/generative-ai");

const apiKey = AIzaSyCBoO8cdangwvhzIJI3l68xt5U2cVC0gnU;
const genAI = new GoogleGenerativeAI(apiKey);

const model = genAI.getGenerativeModel({
  model: "gemini-1.5-flash",
});

const generationConfig = {
  temperature: 1,
  topP: 0.95,
  topK: 64,
  maxOutputTokens: 8192,
  responseMimeType: "text/plain",
};

async function run(inputText) {
  const chatSession = model.startChat({
    generationConfig,
    history: [],
  });

  const result = await chatSession.sendMessage(inputText);
  console.log(result.response.text());
}

// Accept input from command line arguments
const inputText = process.argv[2];
run(inputText);
