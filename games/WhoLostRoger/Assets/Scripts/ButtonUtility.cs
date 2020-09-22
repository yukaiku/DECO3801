using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using System.Runtime.InteropServices;

public class ButtonUtility : MonoBehaviour
{
    public GameObject PauseMenu;
    public GameObject OptionMenu;

    [DllImport("__Internal")]
    private static extern void QuitTab();
    
    public void doLoadScene(string sceneName)
    {
        // global.nowSceneName = sceneName;
        // Debug.Log("Current sceneName:"+ sceneName);
        SceneManager.LoadScene(sceneName);
        Debug.Log(string.Format("Load '{0}' scene", sceneName));
    }

    public void doQuit()
    {
        Application.Quit();
        QuitTab();
        Debug.Log("Game quit.");
    }

    public void doResetNewLevel(int level)
    {
        DataSystem.resetNewLevel(level);
    }

    public void doNextLevel()
    {
        int currentLevel = DataStorage.getCurrentLevel();
        DataSystem.resetNewLevel(currentLevel + 1);
    }

    public void doOption(){
        PauseMenu = GameObject.Find("MainPauseMenu");
        OptionMenu = GameObject.Find("MainOptionMenu");
        PauseMenu.transform.position =  new Vector3(-5000, -5000,0);
        OptionMenu.GetComponent<RectTransform>().anchoredPosition =  new Vector3(0,0,0);
    }

    public void doBack(){
        PauseMenu = GameObject.Find("MainPauseMenu");
        OptionMenu = GameObject.Find("MainOptionMenu");
        PauseMenu.GetComponent<RectTransform>().anchoredPosition =  new Vector3(0,0,0);
        OptionMenu.transform.position =  new Vector3(-5000, -5000,0);
    }


    public void doPause(){
        global.isPause = true;
        PauseMenu = GameObject.Find("MainPauseMenu");
        PauseMenu.GetComponent<RectTransform>().anchoredPosition =  new Vector3(0,0,0);
    }


    public void doRetry(){
        global.isPause = false;
        PauseMenu = GameObject.Find("PauseMenu");
        PauseMenu.transform.position =  new Vector3(-5000, -5000,0);
        doLoadScene(global.nowSceneName);
    }

    public void doResume(){
        global.isPause = false;
        PauseMenu = GameObject.Find("MainPauseMenu");
        PauseMenu.transform.position =  new Vector3(-5000, -5000,0);

    }

    public void doExitLevel(string sceneName){
        global.isPause = true;
        SceneManager.LoadScene(sceneName);
        Debug.Log(string.Format("Load '{0}' scene", sceneName));
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {

    }

    // Update is called once per frame
    void Update()
    {

    }
}
