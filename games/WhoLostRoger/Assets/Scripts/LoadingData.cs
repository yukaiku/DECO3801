using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using System.Runtime.InteropServices;

public class LoadingData : MonoBehaviour
{

    private string urlLink = "https://deco3801-cats.uqcloud.net/games/GameExecutables/WhoLostRoger/loadData.php";

    IEnumerator loadDataRequest()
    {
        WWWForm formData = new WWWForm();
        formData.AddField("getStudentProgress", "yes");

        using (UnityWebRequest www = UnityWebRequest.Post(urlLink, formData))
        {
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                string studentProgress = www.downloadHandler.text;
                Debug.Log(string.Format("Get student progress data success! {0}", studentProgress));
                loadDataIn(studentProgress);
            }
        }
    }

    public void loadDataIn(string studentProgress)
    {
        int gameId = 0;
        int playerId = 0;
        int highestLevel = 0;

        string[] info = studentProgress.Split('|');
        for (int i = 0; i < info.Length; i++)
        {
            int separator = info[i].IndexOf(":");
            if (info[i].Substring(0, separator) == "game_id")
            {
                gameId = int.Parse(info[i].Substring(separator + 1));
            } else if (info[i].Substring(0, separator) == "player_id")
            {
                playerId = int.Parse(info[i].Substring(separator + 1));
            } else if (info[i].Substring(0, separator) == "highest_level")
            {
                highestLevel = int.Parse(info[i].Substring(separator + 1));
            } else
            {
                Debug.Log(string.Format("some weird data received. {0}", info[i]));
            }
        }

        DataStorage.setGameId(gameId);
        DataStorage.setPlayerId(playerId);
        DataStorage.setHighestLevel(highestLevel);
    }

    public void initData()
    {
        DataSystem.resetNewLevel(1);
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        if (DataStorage.getPlayerId() == 0)
        {
            StartCoroutine(loadDataRequest());
            initData();
        }
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
