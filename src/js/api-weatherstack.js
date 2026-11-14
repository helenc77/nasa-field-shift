//const weatherLocation = 'PL146SA';
//const weatherLocation = 'London';
const weatherLocation = '50.48672,-4.47061';
var thisLocation;
var thisWeather;

const fetchWeatherData = async (location) => {
    const apiKey = weatherstackApiKey; 
    const baseUrl = 'https://api.weatherstack.com/current';
    const query = `?access_key=${apiKey}&query=${location}`;

    try {
        const response = await fetch(baseUrl + query);
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const data = await response.json();
        //console.log(data);
        document.getElementById("this-location").innerHTML = data.location.name;
        document.getElementById("this-weather").innerHTML = data.current.weather_descriptions.join(",");

    } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
    }
};

fetchWeatherData(weatherLocation);
