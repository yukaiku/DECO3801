using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using System.Runtime.InteropServices;

/*
 * This component script is used for providing UI button utilties while a 
 * button object is clicked. There are many events for such trigger.
 * 
 * In Unity inspector,
 * @require GameObject           PauseMenu    (optional)
 * @require GameObject           OptionMenu   (optional)
 * 
 */
public class ButtonUtility : MonoBehaviour
{
    public GameObject PauseMenu;
    public GameObject OptionMenu;

    [DllImport("__Internal")]
    private static extern void BackTabJS();
    
    public void doLoadScene(string sceneName)
    {
        // global.nowSceneName = sceneName;
        // Debug.Log("Current sceneName:"+ sceneName);
        SceneManager.LoadScene(sceneName);
        Debug.Log(string.Format("Load '{0}' scene", sceneName));
    }

    public void doResetNewLevel(int level)
    {
        DataSystem.resetNewLevel(level);
    }

    public void doQuit()
    {
        Application.Quit();
        BackTabJS();
        Debug.Log("Game quit.");
    }

    public void doAgain()
    {
        int currentLevel = DataStorage.getCurrentLevel();
        DataSystem.resetNewLevel(currentLevel);
        int currentSceneInd = SceneManager.GetActiveScene().buildIndex;
        SceneManager.LoadScene(currentSceneInd);
    }

    public void doNextLevel()
    {
        int currentLevel = DataStorage.getCurrentLevel();
        DataSystem.resetNewLevel(currentLevel + 1);
        int currentSceneInd = SceneManager.GetActiveScene().buildIndex;
        SceneManager.LoadScene(currentSceneInd + 1);
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
