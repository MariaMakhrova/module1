
using System;

public interface ITranslator
{
	string Translate(string text, string fromLanguage, string toLanguage);
}

public class GoogleTranslateTranslator : ITranslator
{
	public string Translate(string text, string fromLanguage, string toLanguage)
	{
		
		string translatedText = GoogleTranslate.Translate(text, fromLanguage, toLanguage);
		return $"Google Translate: {translatedText}";
	}
}

public class ChatGPTTranslator : ITranslator
{
	public string Translate(string text, string fromLanguage, string toLanguage)
	{
		Response response = ChatGPT.Ask($"Translate '{text}' from {fromLanguage} to {toLanguage}");
		string translatedText = response.Answer;
		return $"ChatGPT Translate: {translatedText}";
	}
}

public class TranslationContext
{
	private ITranslator translator;

	public TranslationContext(ITranslator translator)
	{
		this.translator = translator;
	}

	public void SetTranslator(ITranslator translator)
	{
		this.translator = translator;
	}

	public string Translate(string text, string fromLanguage, string toLanguage)
	{
		return translator.Translate(text, fromLanguage, toLanguage);
	}
}

class Program
{
	static void Main()
	{
		
		var googleTranslateTranslator = new GoogleTranslateTranslator();
		var translationContext = new TranslationContext(googleTranslateTranslator);

	
		Console.Write("Enter the text to translate: ");
		string userText = Console.ReadLine();

		string translatedText = translationContext.Translate(userText, "en", "uk");
		Console.WriteLine(translatedText);

		var chatGPTTranslator = new ChatGPTTranslator();
		translationContext.SetTranslator(chatGPTTranslator);

	
		Console.Write("Enter the text to translate using ChatGPT: ");
		userText = Console.ReadLine();

		translatedText = translationContext.Translate(userText, "en", "uk");
		Console.WriteLine(translatedText);
	}
}
public class TranslationContext
{
	private ITranslator translator;

	public TranslationContext(ITranslator translator)
	{
		this.translator = translator;
	}

	public void SetTranslator(ITranslator translator)
	{
		this.translator = translator;
	}

	public string Translate(string text, string fromLanguage, string toLanguage)
	{
		
		return translator.Translate(text, fromLanguage, toLanguage);
	}
}

class Program
{
	static void Main()
	{
		var googleTranslateTranslator = new GoogleTranslateTranslator();
		var translationContext = new TranslationContext(googleTranslateTranslator);

		string translatedText = translationContext.Translate("Text to translate", "en", "uk");
		Console.WriteLine(translatedText);

		var chatGPTTranslator = new ChatGPTTranslator();
		translationContext.SetTranslator(chatGPTTranslator);

		translatedText = translationContext.Translate("Text to translate", "en", "uk");
		Console.WriteLine(translatedText);
	}
}